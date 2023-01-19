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
            $table->integer('manager')->default('0');
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
            $table->string('manager')->nullable();
            $table->string('employee_code')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birthdate');
            $table->string('civil_status');
            $table->bigInteger('contact_number');
            $table->string('gender');
            $table->string('email')->unique();
            $table->string('address');
            $table->string('perma_address');
            $table->string('elementary')->nullable();
            $table->string('highschool')->nullable();
            $table->string('college')->nullable();
            $table->string('yearElem')->nullable();
            $table->string('yearHigh')->nullable();
            $table->string('yearCollege')->nullable();
            $table->string('degree')->nullable();
            $table->bigInteger('sss')->nullable();
            $table->bigInteger('tin')->nullable();
            $table->bigInteger('pagibig')->nullable();
            $table->bigInteger('philhealth')->nullable();
            $table->string('image')->nullable();
            $table->softDeletes();

            $table->timestamps();

            // foreign keys
            $table->foreign('department_id')->references('id')->on('department');
            $table->foreign('job_id')->references('id')->on('job');
            $table->foreign('schedule_id')->references('id')->on('schedule');
        });

        Schema::create('attendances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->date('date');
            $table->string('time_in');
            $table->integer('status');
            $table->string('time_out');
            $table->float('num_hr');
            $table->softDeletes();

            $table->timestamps();

            // foreign keys
            $table->foreign('employee_id')->references('id')->on('employee');

        });

        Schema::create('cashadvances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->string('description');
            $table->date('date');
            $table->float('amount');
            $table->softDeletes();
            $table->timestamps();

            // foreign keys
            $table->foreign('employee_id')->references('id')->on('employee');

        });

        Schema::create('deductions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description');
            $table->float('amount');
            $table->softDeletes();
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
        Schema::dropIfExists('human_resources');
    }
};
