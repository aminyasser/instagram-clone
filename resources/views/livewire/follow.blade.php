<div>

    <div class="container">
        <div class="row">


        <div class="offset-md-1 col-md-3">
            <p id="username"> {{$user->username}} </p>
        </div>
        <div class="col-md-2 edit-profile text-dark">
            @if($is_profile)
            <form method="get" action="{{route('user.edit' , Auth::user()->id)}}">
                @csrf
                <button type="submit">Edit Profile</button>
            </form>
            @else
            <button type="submit" class="{{$followClass}} mt-3 f-btn"  wire:click="click"> {{$buttonContent}} </button>

            @endif
        </div>


        <div class="col-md-1 setting">
            <ul>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" >
                        <img src="{{asset('images/setting.png')}}" alt="" class="profile">
                    </a>
                    </li>
            </ul>
        </div>
</div>
</div>
<div class="container">

<div class="row follow">
    <div class="offset-1 col-md-3">
        <a class="Posts" href="#"><strong> {{$user->posts->count()}} </strong> Posts</a>
    </div>
    <div class="col-md-3">
        <a class="followers" data-toggle="modal" data-target="#exampleModalCenter" href="">
            <strong> {{$followersCount}} </strong>Followers</a>
    </div>


    <div class="col-md-3">
        <a class="following"  data-toggle="modal" data-target="#exampleModalCenter1" href="">
             <strong> {{$followingCount}} </strong> Following</a>

    </div>
</div>
</div>

     {{-- Modals --}}

     <div class="modal fade follow-mod" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Followers</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                @foreach ($user->followers as $u )



                    <div class="row py-2">
                        <a href="{{route('user.profile' , $u->username )}}" class="col-md-2">
                            <img style="width: 100%;" class="profile"  src="{{asset('images/users/' . $u->avatar)}}" alt="">
                        </a>
                        <a href="{{route('user.profile' , $u->username )}}" class="col-md-7 link-list">
                            <h4 class="mt-2" style="font-weight: 600; font-size:18px ">{{$u->name}}</h4>
                            <i class="" style="font-weight: 600; font-size:15px ">{{'@'.$u->username}}</i>
                        </a>
                        <div class="col-md-2">
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

    <div class="modal fade follow-mod" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Following</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                @foreach ($user->followings as $u )

                    <div class="row py-2">
                        <a href="{{route('user.profile' , $u->username )}}" class="col-md-2">
                            <img style="width: 100%;" class="profile"  src="{{asset('images/users/' . $u->avatar)}}" alt="">
                        </a>
                        <a href="{{route('user.profile' , $u->username )}}" class="col-md-7 link-list">
                            <h4 class="mt-2" style="font-weight: 600; font-size:18px ">{{$u->name}}</h4>
                            <i class="" style="font-weight: 600; font-size:15px ">{{'@'.$u->username}}</i>
                        </a>
                        <div class="col-md-2">
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

     {{-- End Modals --}}
</div>
