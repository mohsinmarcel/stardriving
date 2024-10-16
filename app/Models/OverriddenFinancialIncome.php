<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OverriddenFinancialIncome extends Model
{
    protected $fillable = [
        'quarter_id',
        'incomeWithoutTax',
        'incomeGST',
        'incomeQST',
        'incomeWithTax',
    ];

}
