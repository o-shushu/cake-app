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
            $table->decimal('price')->nullable()->comment('価格');
            $table->string('size', 32)->nullable()->comment('サイズ');
            $table->integer('amount')->nullable()->comment('数量');
            $table->string('remark', 255)->nullable()->comment('備考');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('carts');
    }
};
