<!-- Start NavBar -->

    <nav class="mb-5 position-fixed nav-fix w-100" >
        <div class="con">
            <div class="box1">

                <div class="heading">

                </div>
            </div>

            <livewire:search >

            <div class="box1">
                <ul>
                    <li><a href="{{route('home')}}" class="home"><img src="{{asset('images/home.png')}}" alt="Home"></a></li>
                    {{-- <form action="{{route('post.new')}}" method="post">

                    </form> --}}
                    <li><a href="{{route('post.new')}}" class="NewPost"><img src="{{asset('images/add (2).png')}}" alt="AddPost" id="NewPost"></a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="true">
                            <img src="{{asset('images/users/' . Auth::user()->avatar)}}" alt="" class="profile preview-image">
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown" id="dorper">
                            <li><a class="dropdown-item" href="{{route('user.profile', Auth::user()->username)}}"><i class="far fa-user-circle"></i> Profile</a></li>
                            <li><a class="dropdown-item" href="{{route('user.profile', Auth::user()->username)}}"><i class="far fa-bookmark"></i> Saved</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{route('logout')}}">Log Out</a></li>
                        </ul>
                        </li>
                </ul>
            </div>
        </div>
    </nav>
