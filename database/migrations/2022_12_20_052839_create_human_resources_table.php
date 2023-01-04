<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('job_name');
            $table->string('description');
            $table->float('rate');
            $table->softDeletes();

            $table->timestamps();
        });

        Schema::create('department', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('department_name');
            $table->softDeletes();

            $table->timestamps();
        });

        Schema::create('schedule', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('time_in');
            $table->string('time_out');
            $table->softDeletes();

            $table->timestamps();
        });

        Schema::create('employee', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('job_id');
            $table->unsignedBigInteger('schedule_id');
            $table->string('employee_code')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('address');
            $table->date('birthdate');
            $table->bigInteger('contact_number');
            $table->string('gender');
            $table->string('image')->nullable();
            $table->softDeletes();

            $table->timestamps();

            // foreign keys
            $table->foreign('department_id')->references('id')->on('department');
            $table->foreign('job_id')->references('id')->on('job');
            $table->foreign('schedule_id')->references('id')->on('schedule');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('human_resources');
    }
};
