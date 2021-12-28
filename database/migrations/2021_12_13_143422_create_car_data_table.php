<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_data', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->comment('會員ID')->nullable();
            $table->date('date')->comment('施工日期')->nullable();
            $table->dateTime('time')->comment('來店時間')->nullable();
            $table->integer('car_type')->comment('車輛品牌型號')->nullable();
            $table->integer('car_model')->comment('車型')->nullable();
            $table->string('item')->comment('項目')->nullable();
            $table->string('VIN')->comment('車輛識別號碼')->nullable();
            $table->string('car_code')->comment('車牌號碼')->nullable();
            $table->integer('milage')->comment('里程數')->nullable();
            $table->integer('price')->comment('價格')->nullable();
            $table->text('giveaway')->comment('贈品')->nullable();
            $table->text('how_to_know')->comment('如何得知')->nullable();
            $table->text('car_situation')->comment('車輛狀況')->nullable();
            $table->string('img')->comment('檢查表圖片')->nullable();
            $table->text('notes')->comment('備註')->nullable();
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
        Schema::dropIfExists('user_car_data');
    }
}
