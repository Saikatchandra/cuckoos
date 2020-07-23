<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerifyIdentitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verify_identities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('pan_card')->nullable();
            $table->string('pan_card_image')->nullable();
            $table->string('aadhaar_card')->nullable();
            $table->string('aadhaar_card_image')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('bank_ac_no')->nullable();
            $table->string('bank_ac_name')->nullable();
            $table->string('full_name')->nullable();
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('verify_identities');
    }
}
