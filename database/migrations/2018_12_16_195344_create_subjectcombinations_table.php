<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectcombinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjectcombinations', function (Blueprint $table) {
            $table->increments('subjectcombination_id');
            $table->integer('class_id')->unsigned();
            $table->integer('subject_id')->unsigned();

            $table->foreign('class_id')->references('class_id')->on('classes');
            $table->foreign('subject_id')->references('subject_id')->on('subjects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subjectcombinations');
    }
}
