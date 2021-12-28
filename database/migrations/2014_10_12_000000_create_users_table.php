<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id()->comment('會員ID');
            $table->string('name')->comment('會員姓名');
            $table->string('email')->comment('會員信箱')->nullable();
            $table->timestamp('email_verified_at')->comment('信箱驗證時間')->nullable();
            $table->string('password')->comment('密碼');
            $table->string('type')->comment('會員類型')->nullable();
            $table->string('tel')->comment('會員電話')->nullable();
            $table->string('phone')->comment('會員手機')->nullable();
            $table->text('address')->comment('地址')->nullable();
            $table->string('ID_number')->comment('身分證字號')->nullable();
            $table->date('birthday')->comment('生日')->nullable();
            $table->tinyInteger('sex')->comment('性別(1:男生 2:女生)')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
