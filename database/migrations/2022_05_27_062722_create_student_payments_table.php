<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained();
            $table->foreignId('student_id')->constrained();
            $table->foreignId('payment_method_id')->constrained();
            $table->date('payment_date');
            $table->decimal('amount');
            $table->mediumText('additional_notes')->nullable();
            $table->string('credit_card')->nullable();
            $table->string('debit_card')->nullable();
            $table->string('card_type')->nullable();
            $table->mediumText('cheque_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_payments');
    }
}
