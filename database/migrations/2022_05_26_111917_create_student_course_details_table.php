<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentCourseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_course_details', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('theoretical_credit_hours');
            $table->smallInteger('practical_credit_hours');
            $table->smallInteger('total_hours');
            $table->decimal('practical_credit_hours_rates');
            $table->decimal('theoretical_credit_hours_rates');
            $table->decimal('sub_total');
            $table->decimal('gst_tax',8,4);
            $table->decimal('qst_tax',8,4);
            $table->decimal('discount');
            $table->enum('discount_type',['price','percent','none']);
            $table->decimal('total_amount');
            $table->decimal('remaining_amount');
            $table->foreignId('student_id')->unique()->constrained();
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
        Schema::dropIfExists('student_course_details');
    }
}
