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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('ユーザーID');
            $table->date('appointment_time', 255)->nullable()->comment('到着予定');
            $table->decimal('total_price')->nullable()->comment('合計金額');
            $table->string('payment_method', 255)->comment('支払方法');
            $table->string('delivery_place', 255)->comment('配達地');
            $table->string('content')->nullable()->comment('注文内容');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
