<nav class="navbar navbar-expand-lg" >
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03"
            aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="{{ route('home') }}"> <img class="px-3" style="float: right;"
                src="{{ asset('assets/img/jayga.png') }}" alt="logo" /></a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

            </ul>
            <ul class="navbar-nav mb-lg-0">
                <li class="nav-item mx-3">
                    <a class="nav-link" aria-current="page" href="#">Why Jayga?</a>
                </li>
                <!--
                
                
                
                -->

                <li class="nav-item mx-3">

                    <a class="nav-link position-relative">
                        <img src="{{ asset('assets/img/globe.png') }}" alt="" srcset=""> EN
                        <!-- 
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                            <small>Coming soon</small>
                            <span class="visually-hidden"></span>
                        </span>
                        -->
                        
                    </a>
                </li>



                @if (Session::has('user'))

                    <li class="nav-item mx-3">
                        @if (DB::table('listings')->where('lister_id', Session::get('user'))->count() > 0)
                            <a class="nav-link " href="{{ route('userdash') }}">
                                <!--
                                    
                                -->
                                Manage your listing

                            </a>
                        @else
                        <a class="nav-link " href="{{ route('step2') }}">
                            <!--
                                
                            -->
                           List your property

                        </a>
                        @endif

                        
                    </li>


                    <!--
                        <li class="nav-item mx-3">
                            <a class="nav-link" href="{{-- route('userprofile')}}">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                               {{-- @if (Session::has('photo')) --}}
                                <img src="{{-- asset('/uploads/'.Session::get('photo'))}}" class="rounded-circle" style="width: 20px; height:auto;" alt=""> 
                                @else
                                    Welcome,
                                @endif
                                
                                <span>
                                    @if (Session::has('user_name'))
                                        {{Session::get('user_name')}}
                                    @else
                                        {{Session::get('phone')}}
                                    @endif
                                </span>

                                
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('logout') --}}">Logout</a>
                        </li>

                        @if (DB::table('notifications')->where('user_id', Session::get('user'))->where('type', 'booking')->count() > 0)
                                    <span
                                        class="position-absolute translate-middle badge rounded-pill bg-danger">
                                        <small>{{ DB::table('notifications')->where('user_id', Session::get('user'))->where('type', 'booking')->count() }}</small>
                                        <span class="visually-hidden"></span>
                                    </span>
                        @endif
                    -->

                    <li class="nav-item mx-1">

                        <div class="dropdown">
                            <a class="btn btn-outline-success dropdown-toggle border-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-bell" aria-hidden="true"></i>
                                @if (DB::table('notifications')->where('user_id', Session::get('user'))->where('type', 'booking')->count() > 0)
                                    <span
                                        class="position-absolute translate-middle badge rounded-pill bg-danger">
                                        <small>{{ DB::table('notifications')->where('user_id', Session::get('user'))->where('type', 'booking')->count() }}</small>
                                        <span class="visually-hidden"></span>
                                    </span>
                                @endif
                            </a>
                          
                            <ul class="dropdown-menu">
                               
                                    <li><a class="dropdown-item" href="{{route('mynotifs')}}">You have {{DB::table('notifications')->where('user_id', Session::get('user'))->where('type', 'booking')->count()}} new notifications </a></li>
                                
                              
                              
                            </ul>
                          </div>

                    </li>



                    <li class="nav-item mx-3">

                        <div class="dropdown">

                            

                            <a href="#" class="btn btn-outline-success dropdown-toggle" type="button"
                                id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">

                                @if (Session::has('photo'))
                                    <img src="{{ asset('/uploads/' . Session::get('photo')) }}" class="rounded-circle"
                                        style="width: 20px; height:auto;" alt="">
                                @else
                                    <i class="bi bi-person-circle"></i>
                                @endif


                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                                <li><a class="dropdown-item" href="{{ route('mybookings') }}">My Bookings </a></li>
                                <li><a class="dropdown-item" href="{{ route('showfavs') }}">My Favourites </a></li>
                                <li><a class="dropdown-item" href="{{ route('mynotifs') }}">Notifications </a></li>
                                <li><a class="dropdown-item" href="{{ route('userdash') }}">Account </a></li>

                                <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>

                            </ul>
                        </div>
                    </li>
                @else
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="{{ route('userdash') }}">
                            <!--
                            <div
                                    style="width: 100%; height: 100%; padding-top: 4px; padding-bottom: 4px; padding-left: 36px; padding-right: 36px; background: #f6f8f8; border-radius: 4.99px; overflow: hidden; justify-content: center; align-items: center; display: inline-flex; opacity: 0.9">
                                    <div
                                        style="color: #158E72; font-size: 16.58px; font-family: epilogue; font-weight: 500; word-wrap: break-word">
                                        List your property
                                    </div>
                                </div>
                        -->
                           List your property

                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="{{ route('clientlogin') }}" class="nav-link">
                            <div
                                style="width: 100%; height: 100%; padding-top: 4px; padding-bottom: 4px; padding-left: 35.80px; padding-right: 36px; background: #158E72; border-radius: 4.99px; overflow: hidden; justify-content: center; align-items: center; display: inline-flex">
                                <div
                                    style="color: white; font-size: 16.58px; font-family: epilogue; font-weight: 500; word-wrap: break-word">
                                    Login
                                </div>
                            </div>
                        </a>

                    </li>
                @endif

            </ul>
        </div>
    </div>
</nav>
