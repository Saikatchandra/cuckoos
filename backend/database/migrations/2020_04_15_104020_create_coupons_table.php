<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('description');
            $table->tinyInteger('type');
            $table->integer('amount');
            $table->boolean('allow_freeshippping')->default(0);
            $table->timestampTz('expiry_date')->nullable();
            $table->integer('usage_limit')->nullable();
            $table->integer('limit_peruser')->nullable();
            $table->integer('min_spend')->nullable();
            $table->boolean('new_user')->nullable();
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('coupons');
    }
}
