<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'bio',
        'phone',
        'website',
        'gender',
        'avatar'
    ];

    public function posts(){
        return $this->hasMany(Post::class);
    }
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'follow_id', 'user_id');
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'follow_id');
    }
    public function saved_posts() {
        return $this->belongsToMany(Post::class , 'saves');
    }
    public function liked_posts() {
        return $this->belongsToMany(Post::class , 'likes');
    }
    public function user_comments() {
        return $this->hasMany(Comment::class);
    }

    public function isAuthUserLikedPost(){
        return $this->likes()->where('user_id',  auth()->id())->exists();
    }

    public function isAuthUserFollowedUser($id){
        return DB::table('follows')->where('user_id' ,  Auth::user()->id )
        ->where('follow_id' , $id)->exists();
    }
    public function isUserSavePost($id){
        return DB::table('saves')->where('user_id' ,  Auth::user()->id )
        ->where('post_id' , $id)->exists();
    }
    public function isUserLikePost($id){
        return DB::table('likes')->where('user_id' ,  Auth::user()->id )
        ->where('post_id' , $id)->exists();
    }
    public function followBack($id){
        return DB::table('follows')->where('user_id' ,  $id )
        ->where('follow_id' , Auth::user()->id)->exists();
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
