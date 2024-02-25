<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id', 'title', 'image', 'amount', 'explain', 'condition', 'status_flg', 'del_fig', 'created_at', 'updated_at',
    ];

    // ユーザーとのリレーションシップを定義する
    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function likes() {
        return $this->hasMany('App\Like', 'post_id', 'id');
    }

    public function buys() {
    return $this->hasMany('App\Buy', 'post_id', 'id');
    }

}

