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
            $table->bigIncrements('id');
            $table->string('name'); // ユーザー名
            $table->string('email')->unique(); // メールアドレス
            $table->string('password'); // パスワード
            $table->string('image')->nullable(); // ユーザーアイコン
            $table->text('profile')->nullable(); // 自己紹介文
            $table->integer('role')->default(1)->comment('管理=0/一般=1'); // ユーザー区分
            $table->boolean('del_flag')->default(false)->comment('削除=TRUE'); // ユーザー論理削除
            $table->string('reset_token')->nullable()->comment('パスワードリセット要求時の一時的なトークン'); // リセットトークン
            $table->timestamps(); // created_atとupdated_atカラムを自動的に追加
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
