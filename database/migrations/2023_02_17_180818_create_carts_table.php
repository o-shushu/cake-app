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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('ユーザーID');
            $table->unsignedBigInteger('cake_id')->comment('ケーキID');
            $table->unsignedBigInteger('shop_id')->comment('店舗ID');
            $table->unsignedBigInteger('order_id')->comment('注文ID');
            $table->string('size', 32)->nullable()->comment('サイズ');
            $table->decimal('price')->nullable()->comment('価格');
            $table->integer('amount')->nullable()->comment('数量');
            $table->decimal('subtotal')->nullable()->comment('小計');
            $table->string('remark', 255)->nullable()->comment('備考');
            $table->string('pay_status')->nullable()->comment('支払状態');
            $table->string('order_status')->nullable()->comment('注文状態');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('cake_id')->references('id')->on('cakes')->onDelete('cascade');
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
};
