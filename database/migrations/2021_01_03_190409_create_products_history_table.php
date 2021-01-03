<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_history', function (Blueprint $table) {
            $table->id();
            $table->string('sku_id');//id do item movimentado
            $table->string('action');//se foi criado, movimentado manualmente (+ ou -), feito pedido ou removido
            $table->string('trigger');//se veio do sistema ou API
            $table->bigInteger('order_id')->nullable();//guarda o pedido se a movimentação foi por pedido
            $table->bigInteger('user_id')->nullable();//guarda o cliente se a movimentação foi por pedido
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
        Schema::dropIfExists('products_history');
    }
}
