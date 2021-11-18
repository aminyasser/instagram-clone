@extends('layouts.app')
@section('title')
Instagram
@endsection
@push('custom-css')
<link href="{{asset('css/home.css')}}" rel="stylesheet">
@endpush
@livewireStyles
@section('content')
            @include('includes.navbar')
                                               <!-- Start POST -->
    <section class="py-5">

    <div class="container w-75 py-5">

        <div class="row">
            <div class="col-md-8">

      @if (session('status'))
          <div class="alert alert-success" role="alert">
              {{ session('status') }}
          </div>
      @endif

      @forelse ($posts as $post )


            <div class="par-box2">

                <div class="box2" name="username" class="username" >
                    <a href="{{route('user.profile' , $post->user->username)}}" class="card-title ">
                    <img src="{{asset('images/users/' . $post->user->avatar)}}" id="username">

                    <span class="username-post">{{$post->user->username}}</span> </a>
                </div>
                <div class="box2">

                    <ul>

                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle post-edit" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="true">
                                ...
                            </a>
                            @if($post->user_id == Auth::user()->id)
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown" id="dorper">
                                <form action="{{route('post.delete' , $post->id)}}" method="GET">
                                    @csrf
                                <button style="position: relative;z-index:20;"
                                type="submit" class="dropdown-item text-danger" > Delete </button>
                                </form>

                            <!-- <li><hr class="dropdown-divider"></li> -->
                            <li><a class="dropdown-item " href="#">Cancel</a></li>
                            </ul>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card mb-3">
                <a style="width:100%" href="{{route('post.show' , $post->id)}}">
                    <img src="{{asset('images/posts/' . $post->image)}}"
                style="height: 500px" class="card-img-top" alt="...">
                </a>

                <div class="card-body">

                    <livewire:reaction :id="$post->id">

                        <div style="margin-bottom: 5px" class="card-text" id="discreption" name="discreption"><a href="">
                            {{$post->user->name}}
                        </a><small style="font-size:14px"class="">
                            {!!$post->postHash($post->caption)!!}
                        </small></div>
                        @if ($post->comments->count() > 1)
                        <a href="{{route('post.show' , $post->id)}}" style="color:gray; font-size:13px;
                        margin-bottom:0; font-weight:500; text-decoration:none">
                                View all {{$post->comments->count()}} Comments
                        </a>
                        @endif
                        @foreach ( $post->comments as $comment )
                        @if ($loop ->first)
                        <div style="margin-top: 0" class="card-text" id="comment" name="comment">
                            <a href="">{{$comment->user->name}} </a>
                            <small class="">
                                {{$comment->comment}}
                            </small>
                        </div>
                            @endif
                        @endforeach

                        <p style="color:gray; font-size:11px; margin-bottom:0; font-weight:400; text-transform:uppercase">
                            {{$post->created_at->diffForHumans()}}
                        </p>


                </div>

                <livewire:comment-bar :id='$post->id' >

            </div>


    @empty
    <div class="text-center p-5 not-yet">
        <i style="font-size: 40px" class="fas fa-camera py-4"></i>
        <p>No Posts Yet!</p>
        <p>Follow someone to see posts</p>
    </div>
    @endforelse
</div>
<div class="col-md-4 sideBar">
<div class="container">
    <div class="row py-2">
        <div class="col-md-2">
            <img class="w-100 img-home" src="{{asset('images/users/' . $user->avatar)}}" alt="">
        </div>
        <div class="col-md-10">
            <p class="home-username"> {{$user->username}} </p>
            <p class="home-name"> {{$user->name}} </p>
        </div>
    </div>

    <div class="row py-3">
        <p class="suggest-home">Suggestions For You</p>
        <div class="col-md-12 w-75">


        @foreach ($suggests as $sug)

            <div class="row py-2">
                <div class="col-md-2">
                    <img class="w-100 img-suggest" src="{{asset('images/users/' . $sug->avatar)}}" alt="">
                </div>
                <a class="col-md-6 suggest-link" href="{{route('user.profile' , $sug->username)}}">
                    <p class="home-username-suggest"> {{$sug->username}} </p>
                </a>
                <div class="col-md-2">
                    <livewire:follow-btn :id='$sug->id'>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
</div>
</div>
    </div>

</section>

  @livewireScripts
  <script src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
<script >
    $(document).ready(function(){
            window.livewire.on('alert_remove',()=>{

                setTimeout(function(){ $(".alert-success").fadeOut('fast');
                }, 3000); // 3 secs
            });

    });

</script>




@endsection
