<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'image', 'profile', 'role', 'del_fig', 'reset_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'reset_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts() {
        return $this->hasMany('App\Post', 'user_id', 'id');
    }

    public function follows() {
        return $this->hasMany('App\Follow', 'user_id', 'id');
    }
    
    public function likes() {
        return $this->hasMany('App\Like', 'user_id', 'id');
    }
    
    public function buys() {
        return $this->hasMany('App\Buy', 'user_id', 'id');
    }


    public function isFollowing(User $user)
    {
        return (bool) $this->following()->where('follow_id', $user->id)->first();
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'follow_id');
    }

    public function isFollowedBy(User $user)
    {
        return (bool) $this->followers()->where('user_id', $user->id)->first();
    }
    

public function followers()
{
    return $this->belongsToMany(User::class, 'follows', 'follow_id', 'user_id');
}


    public function follow(User $user)
    {
        return $this->following()->attach($user->id);
    }

    public function unfollow(User $user)
    {
        return $this->following()->detach($user->id);
    }

    
}
