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
            $table->unsignedBigInteger('residence_id')->comment('県地ID');
            $table->string('name', 20)->comment('ユーザーネーム');
            $table->string('email', 32)->comment('メールアドレス');
            $table->string('password', 255)->comment('パスワード');
            $table->string('tel', 32)->comment('電話番号');
            $table->string('type', 20)->comment('属性');
            $table->timestamps();

            $table->foreign('residence_id')->references('id')->on('residences')->onDelete('cascade');
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
