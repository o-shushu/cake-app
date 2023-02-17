<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('name', 20)->comment('ユーザーネーム');
            $table->string('email', 32)->comment('メールアドレス');
            $table->string('password', 32)->comment('パスワード');
            $table->string('tel', 32)->comment('電話番号');
            $table->string('residence', 255)->comment('県地');
            $table->string('type', 20)->comment('属性');
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
        Schema::dropIfExists('users');
    }
};
