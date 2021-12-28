<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSearchLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_log', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->comment('會員ID')->nullable();
            $table->text('IP')->comment('登入IP')->nullable();
            $table->string('keyword')->comment('搜尋關鍵字')->nullable();
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
        Schema::dropIfExists('login_log');
    }
}
