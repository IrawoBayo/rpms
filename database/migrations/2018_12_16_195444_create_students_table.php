<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('student_id');
            $table->integer('class_id')->unsigned();
            $table->string('student_id_num');
            $table->string('student_name');
            $table->string('gender');
            $table->string('dob');
            $table->string('student_email');
            $table->string('student_phone_number');
            $table->string('lga');
            $table->string('state_of_origin');
            $table->string('home_address');
            $table->string('sponsor_email');
            $table->string('sponsor_phone_number');
            $table->timestamps();
            $table->foreign('class_id')->references('class_id')->on('classes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
