<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('title', 30);
            $table->string('image', 30);
            $table->string('amount', 10);
            $table->text('explain');
            $table->text('condition');
            $table->tinyInteger('status_flg')->default(0)->comment('(0:販売中, 1:売り切れ)');
            $table->tinyInteger('del_flag')->default(0)->comment('(0:表示, 1:非表示)');
            $table->timestamps(); // created_atとupdated_atカラムを自動的に追加

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
