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
        Schema::create('account_list', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('account_name');
            $table->string('description');
            $table->tinyInteger('status');
            $table->softDeletes();

            $table->timestamps();
        });

        Schema::create('group_list', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('group_name');
            $table->string('description');
            $table->tinyInteger('type');
            $table->tinyInteger('status');
            $table->softDeletes();

            $table->timestamps();
        });

        Schema::create('journal_entry', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('entry_code')->index();
            $table->string('title');
            $table->string('description')->nullable();
            $table->date('entry_date');
            $table->string('partner');
            $table->softDeletes();

            $table->timestamps();

            // foreign keys
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('journal_item', function (Blueprint $table) {
            
            $table->unsignedBigInteger('account_id');
            $table->unsignedBigInteger('group_id');
            $table->string('journ_code');
            $table->float('amount');
            $table->tinyInteger('type');
            $table->softDeletes();

            $table->timestamps();

            // foreign keys
            
            $table->foreign('account_id')->references('id')->on('account_list');
            $table->foreign('group_id')->references('id')->on('group_list');
            $table->foreign('journ_code')->references('entry_code')->on('journal_entry');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
