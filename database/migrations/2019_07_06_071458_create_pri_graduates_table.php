<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriGraduatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pri_graduates', function (Blueprint $table) {
            $table->increments('id');
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
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pri_graduates');
    }
}
