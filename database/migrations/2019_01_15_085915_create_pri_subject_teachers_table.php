<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriSubjectTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pri_subject_teachers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('subject_id');
            $table->integer('user_id');
            $table->timestamps();
            
            $table->foreign('subject_id')->references('id')->on('pri_subjects')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pri_subject_teachers');
    }
}
