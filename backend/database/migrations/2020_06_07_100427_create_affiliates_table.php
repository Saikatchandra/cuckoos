<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffiliatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affiliates', function (Blueprint $table) {
            $table->id();
            $table->string('updated_by')->nullable();
            $table->integer('level1')->default(0);
            $table->integer('level2')->default(0);
            $table->integer('level3')->default(0);
            $table->integer('level4')->default(0);
            $table->integer('level5')->default(0);
            $table->integer('level6')->default(0);
            $table->integer('level7')->default(0);
            $table->integer('level8')->default(0);
            $table->integer('level9')->default(0);
            $table->integer('level10')->default(0);
            $table->integer('cart_percentage')->default(0);
            $table->integer('min_withdraw')->default(0);
            $table->integer('rupee_to_points')->default(0);
            $table->integer('new_user_points')->default(500);
            $table->integer('referrer_user_points')->default(1000);
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
        Schema::dropIfExists('affiliates');
    }
}
