<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->bigInteger('product_id')->unsigned();
            $table->float('price')->nullable();
            $table->string('sku')->nullable();
            $table->string('position')->nullable();
            $table->string('inventory_policy')->nullable();
            $table->string('compare_at_price')->nullable();
            $table->string('fulfillment_service')->nullable();
            $table->string('inventory_management')->nullable();
            $table->string('option1')->nullable();
            $table->string('option2')->nullable();
            $table->string('option3')->nullable();
            $table->string('taxable')->nullable();
            $table->string('barcode')->nullable();
            $table->integer('grams')->nullable();
            $table->string('image_id')->nullable();
            $table->string('weight')->nullable();
            $table->string('weight_unit')->nullable();
            $table->bigInteger('inventory_item_id')->nullable();
            $table->integer('inventory_quantity')->nullable();
            $table->integer('old_inventory_quantity')->nullable();
            $table->string('tax_code')->nullable();
            $table->string('requires_shipping')->nullable();
            $table->string('admin_graphql_api_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products');
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
        Schema::dropIfExists('product_variants');
    }
}
