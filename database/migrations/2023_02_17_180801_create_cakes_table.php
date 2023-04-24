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
        Schema::create('cakes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shop_id')->comment('店舗ID');
            $table->string('cake_name', 32)->comment('ケーキネーム');
            $table->string('cake_category', 32)->comment('カテゴリー');
            $table->string('cake_content', 512)->comment('ケーキ詳細');
            $table->timestamps();

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
        Schema::dropIfExists('cakes');
    }
};
