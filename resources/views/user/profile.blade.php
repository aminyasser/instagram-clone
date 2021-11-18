@extends('layouts.app')
@section('title')
{{$user->name . ' (@' . $user->username . ')'}}
@endsection
@push('custom-css')
<link href="{{asset('css/profile.css')}}" rel="stylesheet">
@endpush
@livewireStyles
@section('content')
@include('includes.navbar')

<section class="py-5">


<div class="con-profile-border py-5">
<div class="contanier-profile">


    <div class="big-box1">
        <i style="cursor: pointer"  data-toggle="modal" data-target="#upload-popup">
            <img src="{{asset('images/users/'. $user->avatar)}}"
             class="update-color preview-image"
            alt="Profile" id="profile-img">
        </i>
    </div>
     <!-- Modal -->
        <div class="modal fade" id="upload-popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-body">

                    <ul class="list-group text-center">

                        <livewire:upload-image >

                    <li class="list-group-item"><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button></li>
                    </ul>

                </div>

            </div>
            </div>
        </div>
    <div class="big-box2">

        <livewire:follow :id='$user->id' >


        <div class="only-name">
            <div class="naming">
                <h5>{{$user->name}} </h5>
            </div>
            <div class="bio">
                <p> {{$user->bio }} </p>
            </div>
        </div>
    </div>
</div>
<div class="container">


<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-th"></i> Posts</button>
    </li>

    @if(Auth::user()->id == $user->id)
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false"> <i class="far fa-bookmark"></i> Saved</button>
    </li>
    @endif
</ul>
</div>
    <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="container w-75">
            <div class="row">

            {{-- Posts --}}
            @forelse ($posts as $post )
            <div class="col-md-4 pt-3">
                <a href="{{route('post.show' , $post->id)}}">
                    <div class="post-img">
                    <img style="height: 293px;" class='w-100' src="{{asset('images/posts/' . $post->image)}}" alt="">
                    <div class="layo">
                        <i class="like-icon">{{$post->users_like_it->count()}} <i class="fas fa-heart"></i> </i>
                        <i class="comment-icon"> {{$post->comments->count()}} <i class="fas fa-comment"></i></i>
                    </div>
                </div>
                </a>
            </div>
            @empty
            <div class="text-center p-5 not-yet">
                <i style="font-size: 40px" class="fas fa-camera py-4"></i>
                <p>No Posts Yet!</p>
            </div>
            @endforelse


        </div>
    </div>
    </div>
    @if(Auth::user()->id == $user->id)
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="container">
            <div class="row">
            {{-- Saved Posts --}}
            @forelse ($user->saved_posts as $post )
            <div class="col-md-4 pt-3">
                <a href="{{route('post.show' , $post->id)}}">
                    <div class="post-img">
                    <img style="height: 293px;" class='w-100' src="{{asset('images/posts/' . $post->image)}}" alt="">
                    <div class="layo">
                        <i class="like-icon">{{$post->users_like_it->count()}} <i class="fas fa-heart"></i> </i>
                        <i class="comment-icon"> {{$post->comments->count()}} <i class="fas fa-comment"></i></i>
                    </div>
                </div>
                </a>
            </div>
            @empty
            <div class="text-center p-5 not-yet">
                <i style="font-size: 40px" class="fas fa-camera py-4"></i>
                <p>No Saved Posts Yet!</p>
            </div>
            @endforelse


        </div>
        </div>
    </div>

    @endif

    </div>

</div>

</section>

@livewireScripts
<script src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
<script>

    Livewire.on('fileChoosen', () => {
        let input = document.getElementById('upload-img');
        let file = input.files[0];
        let reader = new FileReader();

        reader.onload=function(e){
                window.Livewire.emit('imageUpload' , reader.result);
                let image = document.getElementsByClassName("preview-image");
                for (var x = 0 ; x < image.length ;x++) {
                      image[x].src = e.target.result;
                }
            }
            reader.readAsDataURL(file);
            $(document).ready(function(){
            // Open modal on page load
            $("#upload-popup").removeClass("in");
            $(".modal-backdrop").remove();
            $('body').removeClass('modal-open');
            $('body').css('padding-right', '');
            $("#upload-popup").hide();
            });
        });

    Livewire.on('deletePhoto', () => {
        window.Livewire.emit('deleteImage');
        let image = document.getElementsByClassName("preview-image");
        for (var x = 0 ; x < image.length ;x++) {
                image[x].src = '{{asset('images/users/def.jpg')}} ';
        }

        $(document).ready(function(){
        // Open modal on page load
        $("#upload-popup").removeClass("in");
        $(".modal-backdrop").remove();
        $('body').removeClass('modal-open');
        $('body').css('padding-right', '');
        $("#upload-popup").hide();


            });
        });

</script>

@endsection

