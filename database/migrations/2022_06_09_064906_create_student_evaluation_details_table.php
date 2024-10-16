<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentEvaluationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_evaluation_details', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('student_evaluation_id')->constrained();
            $table->enum('type',['strength','weakness']);
            $table->enum('evaluation_by',['student','teacher']);
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
        Schema::dropIfExists('student_evaluation_details');
    }
}
