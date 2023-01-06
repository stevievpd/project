<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('warehouse_name')->unique();
            $table->string('warehouse_description');
            $table->string('abrr')->unique();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('suppliers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('supplier_name')->unique();
            $table->string('supplier_phone');
            $table->string('supplier_email')->unique();
            $table->string('supplier_address');
            $table->string('note');
            $table->string('photo', 300);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('debts_suppliers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('supplier_id');
            $table->float('amount');
            $table->string('note');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('supplier_id')->references('id')->on('suppliers');

        });


        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category_name')->unique();
            $table->string('category_description');
            $table->string('abrr')->unique();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_name')->unique();
            $table->string('product_description');
            $table->string('product_supplier_name')->unique();
            $table->float('product_supplier_price');
            $table->float('product_retail_price');
            $table->float('product_wholesale_price');
            $table->integer('product_qoh');
            $table->string('product_unit');
            $table->integer('product_min_qoh');
            $table->unsignedBigInteger('warehouse_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('supplier_id');
            $table->integer('product_max_discount');
            $table->string('note');
            $table->string('photo', 300);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('warehouse_id')->references('id')->on('warehouse');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
        });

        Schema::create('product_in_warehouse', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('warehouse_id');
            $table->integer('quantity');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('warehouse_id')->references('id')->on('warehouse');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory');
    }
};
