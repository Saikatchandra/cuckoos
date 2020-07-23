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
            $table->id();
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->unsignedBigInteger('brand_id');
            $table->string('image');
            $table->text('description');
            $table->text('information')->nullable();
            $table->integer('stock');
            $table->bigInteger('price');
            $table->bigInteger('sale_price')->nullable();
            $table->integer('comission')->default(0);
            $table->string('sku')->nullable();
            $table->string('origin')->nullable();
            $table->boolean('recommended')->default(false);
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('product_categories')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('product_brands')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('sub_categories');
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
