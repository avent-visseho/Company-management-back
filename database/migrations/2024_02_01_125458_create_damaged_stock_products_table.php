<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDamagedStockProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('damaged_stock_products', function (Blueprint $table) {
            $table->id('id_DamagedStockProduct');
            $table->unsignedBigInteger('stock_id');
            $table->timestamps();

            $table->foreign('stock_id')->references('id_stock')->on('stocks')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('damaged_stock_products', function (Blueprint $table) {
            //
        });
    }
}
