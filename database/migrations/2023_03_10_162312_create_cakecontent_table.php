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
        Schema::create('cakecontent', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cake_id')->comment('ケーキID');
            $table->decimal('cake_price')->nullable()->comment('ケーキ価格');
            $table->string('cake_size', 32)->nullable()->comment('ケーキサイズ');
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
        Schema::dropIfExists('cakecontent');
    }
};
