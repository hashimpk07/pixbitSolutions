<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->date('joining_date');
            $table->date('dob');
            $table->tinyInteger('gender')->comment(' 1 => Male , 2 => Female');
            $table->string('mobile');
            $table->string('phone')->nullable();;
            $table->string('email');
            $table->string('present_address')->nullable();
            $table->string('permenant_address')->nullable();
            $table->tinyInteger('same_address')->comment(' 1 => Same , 0 => different');
            $table->tinyInteger('status')->comment(' 1 => Active , 0 => Inactive');;
            $table->string('image');
            $table->string('resume')->nullable();
            $table->unsignedBigInteger('designation_id');
            $table->foreign('designation_id')->references('id')->on('designation')->onDelete('cascade');
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
        Schema::dropIfExists('employee');
    }
}
