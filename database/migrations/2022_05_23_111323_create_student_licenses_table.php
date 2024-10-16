<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentLicensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_licenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId("student_id")->unique()->constrained();
            $table->string("certificate_number")->nullable();
            $table->string("license_number")->nullable();
            $table->date("license_issuing_date")->nullable();
            $table->date("license_expiry_date")->nullable();
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
        Schema::dropIfExists('student_licenses');
    }
}
