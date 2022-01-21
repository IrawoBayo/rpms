<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSsTeacherRemarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ss_teacher_remarks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('session_id');
            $table->string('term');
            $table->integer('class_id');
            $table->integer('student_id');
            $table->string('remark');
            $table->timestamps();
            
            $table->foreign('student_id')->references('id')->on('ss_students')->onDelete('cascade');
            $table->foreign('class_id')->references('id')->on('ss_classes')->onDelete('cascade');
            $table->foreign('session_id')->references('session_id')->on('sessions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ss_teacher_remarks');
    }
}
