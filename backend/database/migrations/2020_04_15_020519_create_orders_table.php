<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use League\CommonMark\Extension\Table\Table;

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
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('slug')->nullable();
            $table->integer('total_price');
            $table->integer('shipping_cost');
            $table->unsignedTinyInteger('payment_status')->default(0);
            $table->tinyInteger('coupon_code')->nullable();
            $table->tinyInteger('coupon_type')->nullable();
            $table->integer('coupon_amount')->nullable();
            $table->integer('discount_amount')->nullable();
            $table->tinyInteger('product_count');
            $table->string("customer_name");
            $table->string('customer_phone');
            $table->string('customer_address');
            $table->string('payment_id');
            $table->string('tracking_link')->nullable();
            $table->string('tracking_code')->nullable();
            $table->unsignedBigInteger('transaction_id')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
