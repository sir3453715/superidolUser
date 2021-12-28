<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserVersionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_version', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->comment('會員ID')->nullable();
            $table->string('column')->comment('欄位')->nullable();
            $table->string('value')->comment('數值')->nullable();
            $table->text('content')->comment('說明')->nullable();
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
