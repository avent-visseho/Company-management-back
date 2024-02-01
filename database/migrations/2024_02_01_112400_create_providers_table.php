<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->id('id_provider');
            $table->string('providerName');
            $table->string('providerEmail');
            $table->string('providerPhone');
            $table->string('providerIfu');
            $table->string('providerAddress');
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
        Schema::dropIfExists('providers');
    }
}
