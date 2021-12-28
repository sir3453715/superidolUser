<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_items', function (Blueprint $table) {
            $table->id();
            $table->integer('car_data_id')->comment('車輛資料ID')->nullable();
            $table->string('location')->comment('位置')->nullable();
            $table->string('paper_type')->comment('隔熱紙型號')->nullable();
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
        Schema::dropIfExists('car_items');
    }
}
