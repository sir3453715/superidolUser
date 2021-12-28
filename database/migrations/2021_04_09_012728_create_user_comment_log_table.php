<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCommentLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_comment_log', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->comment('會員ID')->nullable();
            $table->integer('type')->comment('類型')->nullable();
            $table->dateTime('dateTime')->comment('紀錄時間')->nullable();
            $table->integer('author')->comment('紀錄人')->nullable();
            $table->text('content')->comment('備註內容')->nullable();
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
        Schema::dropIfExists('action_log');
    }
}
