<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->integer('number')->nullable();
            $table->string('user_id')->nullable();
            $table->string('name')->nullable();
            $table->smallInteger('financial_status')->nullable();
            $table->smallInteger('fulfillment_status')->nullable();
            $table->json('items')->nullable();
            $table->integer('total_weight')->nullable();
            $table->float('total_price')->nullable();
            $table->string('token');
            $table->float('subtotal_price')->nullable();
            $table->string('delivery_method')->nullable();
            $table->string('total_tax')->nullable();
            $table->string('taxes_included')->nullable();
            $table->json('remaining_items')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
