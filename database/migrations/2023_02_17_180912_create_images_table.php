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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cake_id')->comment('ケーキID');
            $table->unsignedBigInteger('shop_id')->comment('店舗ID');
            $table->string('image_name', 255)->comment('画像ネーム');
            $table->string('image_type', 255)->comment('画像型');
            $table->string('tmp_name', 255)->comment('画像のパス');
            $table->string('image_size', 255)->comment('画像サイズ');

            $table->foreign('shop_id')->references('id')->on('shops');
            $table->foreign('cake_id')->references('id')->on('cakes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
};
