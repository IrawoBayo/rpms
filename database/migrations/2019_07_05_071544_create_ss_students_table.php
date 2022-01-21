<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSsStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ss_students', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('class_id')->unsigned();
            $table->string('student_id_num');
            $table->string('student_name');
            $table->string('gender');
            $table->string('dob');
            $table->string('student_email')->null();
            $table->string('student_phone_number')->null();
            $table->string('lga');
            $table->string('state_of_origin');
            $table->string('home_address');
            $table->string('sponsor_email')->null();
            $table->string('sponsor_phone_number');
            $table->timestamps();

            $table->foreign('class_id')->references('id')->on('ss_classes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ss_students');
    }
}
