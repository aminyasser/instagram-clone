<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'image',
        'caption',
        'user_id'
    ];
    use HasFactory;

    public function user () {
       return $this->belongsTo(User::class);
    }
    public function tags () {
        return $this->belongsToMany(Tag::class , 'post_tag');
    }

    // for saves we will not use it
    public function users() {
        return $this->belongsToMany(User::class, 'saves');
    }
    public function users_like_it() {
        return $this->belongsToMany(User::class, 'likes');
    }
    public function comments() {
        return $this->hasMany(Comment::class);
    }
    public function postHash ($post) {
        $post = preg_replace_callback("/#([\w]+)/",function($match) {
            return "<a class='hash-post'
            href='". route('post.hashtag',str_replace('#' , '' ,$match[0]))."'>
            $match[0]</a>";
        } , $post);

        return $post;
    }

}
