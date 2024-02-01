<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('id_product');
            $table->string('productName');
            $table->integer('unitPrice');
            $table->foreignId('category_id')
            ->nullable()
            ->constrained('categories')
            ->onUpdate("cascade")
            ->onDelete("cascade");
            $table->timestamp('created_at')->nullable() ;
            $table->timestamp('updated_at')->nullable() ;
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
