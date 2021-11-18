
<div>
<div class="par-box1">

<div class="par-box2 status-place">
        <div class="box2">
            <a href="{{route('user.profile' , $post->user->username)}}" class="card-title" id="username-id" >
                 <img src="{{asset('images/users/' . $post->user->avatar)}}" class="username">
                 <span > {{$post->user->username}} </span> </a>
        </div>

        <div class="box2">

            <ul>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle post-edit" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="true" >
                        ...
                    </a>
                    @if($post->user_id == Auth::user()->id)
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown" id="dorper">
                        <form action="{{route('post.delete' , $post->id)}}" method="GET">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger" > Delete </button>
                        </form>

                    <!-- <li><hr class="dropdown-divider"></li> -->
                    <li><a class="dropdown-item " href="#">Cancel</a></li>
                    </ul>
                   @endif
                  </li>
            </ul>
        </div>

    </div>
    <div class="overflow-auto mb-2">

        <div class=" py-3">
            <p class="card-text-comment mt-3" >
                <a href="{{route('user.profile' , $post->user->username)}}"
                style="font-size: 17px" class="card-title-caption"  >
                <img src="{{asset('images/users/' . $post->user->avatar)}}" class="username">
                <strong> {{$post->user->username}} </strong>
                </a>
                <span id="username-caption">{!!$post->postHash($post->caption)!!}</span>
                <i style="color:gray; font-size:11px; margin-bottom:0;
                font-weight:400; text-transform:uppercase; margin-left:5px">
                {{$post->created_at->diffForHumans()}}</i>
             </p>
        </div>

            @foreach ($post->comments as $comment )



                <div class="my-3">
                <a href="{{route('user.profile' , $comment->user->username)}}" class="card-title-comment ml-3"  >
                <img src="{{asset('images/users/' . $comment->user->avatar)}}" style="border-radius: 50%; width:30px">
                <strong> {{$comment->user->username}} </strong>
                </a>
                <span class="username-comment ml-2">{{$comment->comment}}</span>
                <p style="margin-top: 5px; color:gray; font-size:9px; margin-bottom:0;
                 font-weight:400; text-transform:uppercase; margin-left:5px">
                 {{$comment->created_at->diffForHumans()}}</p>
            </div>


        @endforeach
</div>
</div>


@error('comment')
<div class="alert alert-danger" >
   <span>{{ $message }}</span>
</div>
@enderror


          <livewire:reaction :id="$post->id">

          <div class="comment-wrapper">
            <a href="#">
            <img src="{{asset('images/Smile.png')}}" class="icon" alt="">
          </a>
          <form wire:submit.prevent='save' style="display: inline-block; width: 100%">
            @csrf
           <input name="comment" wire:model='comment' type="text" class="comment-box" placeholder="Add a comment...">
           <button type="submit"class="comment-btn">Post</button>
       </form>
        </div>

</div>


