<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buy extends Model
{
    protected $fillable = [
        'user_id', 'post_id', 'name', 'tel', 'post_code', 'address', 'created_at', 'updated_at',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
}

