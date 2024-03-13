<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="{{route('userdash')}}">
            <h2><img class="px-3" style="float: right;" src="{{ asset('assets/img/logo/Jayga Logo-02.png') }}"
                    width="100" height="80" alt="logo" /></h2>

        </a>
        <div class="collapse navbar-collapse px-5 " id="navbarTogglerDemo03">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="{{route('home')}}">Explore</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('step2')}}">List your home</a>
                </li>
                

            </ul>

            <div class="dropdown">
                <a href="#" class="btn btn-warning dropdown-toggle" type="button"
                    id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle"></i>

                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="{{route('userprofile')}}">Profile</a></li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>

                </ul>
            </div>

        </div>
    </div>
</nav>