<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriPrincipalRemarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pri_principal_remarks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('session_id');
            $table->string('term');
            $table->integer('class_id');
            $table->integer('student_id');
            $table->string('remark');
            $table->timestamps();
            
            $table->foreign('student_id')->references('id')->on('pri_students')->onDelete('cascade');
            $table->foreign('class_id')->references('id')->on('pri_classes')->onDelete('cascade');
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
        Schema::dropIfExists('pri_principal_remarks');
    }
}
