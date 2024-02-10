<nav class="navbar navbar-expand-lg " >
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="{{route('home')}}"> <img class="px-3" style="float: right;"
                src="{{asset('assets/img/logo/Jayga Logo-02.png')}}" width="100" height="80" alt="logo" /></a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

            </ul>
            <ul class="navbar-nav mb-lg-0">
                <!--
                <li class="nav-item mx-3">
                    <a class="nav-link" aria-current="page" href="#">Services</a>
                </li>
                
                <li class="nav-item mx-3">
                    <a class="nav-link "><img src="{{asset('assets/img/globe.png')}}" alt="" srcset=""> EN</a>
                </li>
                -->
                
                <li class="nav-item mx-3">
                    <a class="nav-link " href="{{route('userdash')}}">
                        
                        <div
                                style="width: 100%; height: 100%; padding-top: 4px; padding-bottom: 4px; padding-left: 36px; padding-right: 36px; background: #f6f8f8; border-radius: 4.99px; overflow: hidden; justify-content: center; align-items: center; display: inline-flex; opacity: 0.9">
                                <div
                                    style="color: #158E72; font-size: 16.58px; font-family: Montserrat; font-weight: 500; word-wrap: break-word">
                                    List your property
                                </div>
                            </div>
                    
                    </a>
                </li>
                
                @if (Session::has('phone'))
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="{{route('userprofile')}}">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            @if (Session::has('photo'))
                               <img src="{{asset('/uploads/'.Session::get('photo'))}}" class="rounded-circle" style="width: 20px; height:auto;" alt=""> 
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
                        <a class="nav-link" href="{{route('logout')}}">Logout</a>
                    </li>
                @else
                    
                    <li class="nav-item">
                        <a href="{{route('clientlogin')}}" class="nav-link">
                            <div
                                style="width: 100%; height: 100%; padding-top: 4px; padding-bottom: 4px; padding-left: 35.80px; padding-right: 36px; background: #158E72; border-radius: 4.99px; overflow: hidden; justify-content: center; align-items: center; display: inline-flex">
                                <div
                                    style="color: white; font-size: 16.58px; font-family: Montserrat; font-weight: 500; word-wrap: break-word">
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