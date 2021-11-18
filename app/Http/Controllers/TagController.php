<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{

    public function index($hash)
    {
        $data['tag']=Tag::where('hashtag' , $hash)->firstOrFail();
        return view('post.hashtag')->with($data);
    }

}
