<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('referrer_id')->nullable();
            $table->unsignedBigInteger('role_id')->default(1);
            $table->string('username')->unique()->nullable();
            $table->string('avatar')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->timestamp('dob')->nullable();
            $table->text('description')->nullable();
            $table->string('facebook')->nullable();
            $table->string('skype')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->boolean('kyc_verification')->default(false);
            $table->boolean('isVerified')->default(false);
            $table->integer('otp')->nullable();
            $table->timestamp('otp_expire')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('referrer_id')->references('id')->on('users');
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
