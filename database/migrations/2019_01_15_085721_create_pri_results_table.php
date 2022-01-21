<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pri_results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('session_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->integer('class_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->string('test_score');
            $table->string('exam_score');
            $table->integer('total');
            $table->string('grade');
            $table->string('remarks');
            $table->rememberToken();
            $table->string('term');
            $table->integer('user_id')->unsigned();
            $table->integer('obt');
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('pri_students');
            $table->foreign('class_id')->references('id')->on('pri_classes');
            $table->foreign('subject_id')->references('id')->on('pri_subjects');
            $table->foreign('session_id')->references('id')->on('sessions');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pri_results');
    }
}
