<div>
    <h5 class="card-title reaction">
    <a style="cursor: pointer"
        wire:click="clickLike">
      <i class="{{$likebuttonClass}}"></i>
    </a>
    <a href=""> <i class="far fa-comment"></i></a>
    <a style="cursor: pointer"
        wire:click="clickSave">
      <i class="{{$savebuttonClass}}"></i>
    </a>
</h5>
<div  class="card-text" name="like" id="like" data-toggle="modal" data-target="#exampleModalCenter">
    <a style="cursor: pointer" > {{$likesCount}} likes</a>
</div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Likes</h5>

        </div>
        <div class="modal-body">
            @foreach ($post as $u )



                <div class="row">
                    <a href="{{route('user.profile' , $u->username )}}" class="col-md-2">
                        <img style="width: 100%;" class="profile"  src="{{asset('images/users/' . $u->avatar)}}" alt="">
                    </a>
                    <a href="{{route('user.profile' , $u->username )}}" class="col-md-6 link-list">
                        <h4 class="mt-2" style="font-weight: 600; font-size:18px ">{{$u->name}}</h4>
                        <i class="" style="font-weight: 600; font-size:15px ">{{'@'.$u->username}}</i>
                    </a>
                    <div class="col-md-3">
                        @if($u->id != Auth::user()->id)
                        <div class="mt-3 hey">
                            <livewire:follow-btn :id='$u->id'>
                        </div>
                        @endif
                    </div>
              </div>


              @endforeach

        </div>

    </div>
    </div>
</div>
</div>

