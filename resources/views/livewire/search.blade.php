<div class="box1 position-relative" id="search">
    <input type="search" wire:model='search' placeholder="&#xf002 Search" style="font-family:Arial, FontAwesome">
        <div class="users-search position-absolute" wire:loading.class.delay='opacity-75'>
            @foreach ($users as $user )
            <a href="{{route('user.profile' , $user->username)}}" class="row search-wrapper p-2">
                <div class="col-md-3 text-center pt-2">
                    <img class="image-search"  src="{{asset('images/users/'. $user->avatar)}}" >
                </div>
                <div class="col-md-9 pt-2">
                    <div class="pt-1">
                        <i class="d-block search-username">{{$user->username}}</i>
                        <i class="search-name"> {{$user->name}} </i>
                    </div>
                </div>
            </a>
            @endforeach

        </div>
</div>
