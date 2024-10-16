<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\DataAwareRule;

class Discount implements Rule,DataAwareRule
{

    protected $data = [];
    protected $taxes;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($tax)
    {
        $this->taxes = $tax;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if($this->data['discount_type'] == 'price'){
            return $value <= $this->totalAmount();
        }else if($this->data['discount_type'] == 'percent'){
            return $value < 100;
        }
        // return strtoupper($value) === $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if($this->data['discount_type'] == 'price'){
            return 'Discount amount must not be greater than '.$this->totalAmount();
        }else if($this->data['discount_type'] == 'percent'){
            return 'Discount % must not be equal or greater than 100';
        }
    }

    public function setData($data)
    {
        $this->data = $data;
 
        return $this;
    }
    protected function totalAmount(){
        // $taxes = ['gst_tax' => $tax[0]['value'],'qst_tax' => $tax[1]['value']];
        $sub_total = $this->data['subtotal'];
        $gst = ($this->taxes['gst_tax']/100)*$sub_total;
        $qst = ($this->taxes['qst_tax']/100)*$sub_total;
        $total_amount = $sub_total+$gst+$qst;
        return round($total_amount,2);
    }
}
