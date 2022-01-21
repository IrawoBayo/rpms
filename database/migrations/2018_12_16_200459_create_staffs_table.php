<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffs', function (Blueprint $table) {
            $table->increments('staff_id');
            $table->integer('subject_id')->unsigned();
            $table->string('staff_id_num');
            $table->string('staff_name');
            $table->string('staff_email');
            $table->string('staff_phone_number');
            $table->integer('user_id')->unsigned();
            $table->foreign('subject_id')->references('subject_id')->on('subjects');
            $table->foreign('user_id')->references('id')->on('users');
            // $table->timestamps();
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staffs');
    }
}
