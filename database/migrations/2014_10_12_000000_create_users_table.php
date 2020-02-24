<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//@codingStandardsIgnoreLine
class CreateUsersTable extends Migration
{
    const a = 1;

    const b = 2;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name')->nullable();
                //$table->string('last_name')->nullable();
                $table->string('password')->nullable();
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();

                $table->string('phone')->nullable();
                $table->boolean('phone_auth')->default(false);
                $table->boolean('phone_verified')->default(false);
                $table->string('phone_verify_token')->nullable();
                $table->timestamp('phone_verify_token_expire')->nullable();


                $table->string('role', 16)->nullable();
                $table->rememberToken();

                $table->string('status', 16)->nullable();
                $table->string('verify_token')->nullable()->unique();

                $table->timestamps();
            });
        }
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
