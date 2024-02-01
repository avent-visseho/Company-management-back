<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('id_order');
            $table->foreignId('product_id')
            ->nullable()
            ->constrained('products')
            ->onUpdate("cascade")
            ->onDelete("cascade");
            $table->foreignId('provider_id')
            ->nullable()
            ->constrained('providers')
            ->onUpdate("cascade")
            ->onDelete("cascade");
            $table->integer('quantity');
            $table->date('orderDate');
            $table->Text('observation');
            $table->boolean('status', 255);
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
        Schema::dropIfExists('orders');
    }
}
