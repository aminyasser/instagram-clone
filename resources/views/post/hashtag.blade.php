@extends('layouts.app')
@section('title')
New Post
@endsection
@push('custom-css')
<link href="{{asset('css/NewPost.css')}}" rel="stylesheet">
@endpush
<style>
    body {
        background-color: #FAFAFA !important;
    }
</style>
@livewireStyles
@section('content')

    @include('includes.navbar')
<section class="py-5">
<div class="container py-5">
<section class="text-center">
    <h3>#{{$tag->hashtag}}</h3>
    <p class="hashtag-posts">{{$tag->posts->count()}} posts</p>
</section>
<div class="container w-75">


<div class="row">
    @foreach ($tag->posts as $post)

    <a href="{{route('post.show' , $post->id)}}" class="col-md-4 pt-3">
        <div class="post-img">
            <img style="height: 250px" class="w-100" src="{{asset('images/posts/' .$post->image)}}" alt="">
            <div class="layo">
                <i class="like-icon">{{$post->users_like_it->count()}} <i class="fas fa-heart"></i> </i>
                <i class="comment-icon"> {{$post->comments->count()}} <i class="fas fa-comment"></i></i>
            </div>
        </div>
    </a>

    @endforeach
</div>
</div>

</div>
</section>
@livewireScripts
<script src="{{asset('js/jquery-3.5.1.min.js')}}"></script>

@endsection
