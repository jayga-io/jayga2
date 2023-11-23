<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>Jayga | Dashboard</title>
    <style>
      .nav-link{
          color: #139175;
          font-size: medium;
          font-weight: 700;
        }

      .card:hover{
          opacity: 1;
            transition: 0.5s;
            transform:scale(1.1);
            
        }
    .disabled {
            pointer-events: none;
            color: #ccc;
        }

    a{
        text-decoration: none;
    }
    </style>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03"
                    aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <h2><img class="px-3" style="float: right;" src="{{asset('assets/img/logo/Jayga Logo-02.png')}}" width="100"
                            height="80" alt="logo" /></h2>
        
                </a>
                <div class="collapse navbar-collapse px-5 " id="navbarTogglerDemo03">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="#">Explore</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">List your home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-disabled="true">Help Center</a>
                        </li>
        
                    </ul>
        
                    <div class="dropdown">
                        <a href="#" class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i>
        
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><a class="dropdown-item" href="{{route('logout')}}">Logout</a></li>
        
                        </ul>
                    </div>
        
                </div>
            </div>
        </nav>
    </div>

    <div class="container">
        @if (count($listing) === 0)
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Looks, like you dont have a listing on our platform. Become a host today and start making money</strong>
                
            </div>
        @endif
       
      <div class="p-3 mb-4 bg-light rounded-3">
        <div class="container-fluid py-4">

          <h1 class="display-5 fw-bold">Account Details</h1>
          <p class="col-md-8 ">Welcome onboard, (+88 {{ $phone }}). <a href="{{route('userprofile')}}">Go to profile</a></p>
          @if (count($listing) === 0)
              <a class="btn btn-success btn-lg" href="/host/setup">Join as a host</a>
          @else
            <a class="btn btn-success btn-lg" href="/host/setup"><i class="bi bi-plus"></i>Add a listing</a>
          @endif
          
        </div>
      </div>
      
    </div>


    <div class="container">
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col">
          <a href="{{route('userprofile')}}"  class=" card h-100">
            <h4 class="p-3" style="color:#139175; font-weight: 900;"><i class="bi bi-person"></i></h4>
            <div class="card-body">
              <h5 class="card-title">Personal Informations</h5>
              <p class="card-text">Provide personal details and how can we reach you</p>
            </div>
          </a>
        </div>
        <div class="col">
          <a href="/host/setup" class="card h-100">
            <h4 class="p-3" style="color:#139175; font-weight: 900;"><i class="bi bi-sliders"></i></h4>
            <div class="card-body">
                @if (count($listing) === 0)
                    <h5 class="card-title">Become a host</h5>
                    <p class="card-text">Become a host on jayga. Start earning money</p>
                @else

                    <h5 class="card-title">Add another listing</h5>
                    <p class="card-text">Adding one more listing will increase your revenue</p>
                @endif
              
            </div>
          </a>
        </div>
        <div class="col" >
            @if (count($listing) === 0)
                <a href="#" class="card h-100 disabled">
                    <h4 class="p-3" style="color:#139175; font-weight: 900;"><i class="bi bi-calendar3"></i></h4>
                    <div class="card-body">
                        <h5 class="card-title">Manage Bookings</h5>
                        <p class="card-text">Manage all your bookings in one place</p>
                    </div>
                </a>
            @else
            <a href="{{route('managebookings')}}" class="card h-100">
                <h4 class="p-3" style="color:#139175; font-weight: 900;"><i class="bi bi-calendar3"></i></h4>
                <div class="card-body">
                    <h5 class="card-title">Manage Bookings</h5>
                    <p class="card-text">Manage all your bookings in one place</p>
                </div>
            </a>
            @endif
          
        </div>

        <div class="col">
            @if (count($listing) === 0)
            <a href="#" class="card h-100 disabled">
                <h4 class="p-3" style="color:#139175; font-weight: 900;"><i class="bi bi-calendar3"></i></h4>
                <div class="card-body">
                    <h5 class="card-title">My Listings</h5>
                    <p class="card-text">Manage all your listings</p>
                </div>
            </a>
        @else
        <a href="#" class="card h-100">
            <h4 class="p-3" style="color:#139175; font-weight: 900;"><i class="bi bi-calendar3"></i></h4>
            <div class="card-body">
                <h5 class="card-title">My Listings</h5>
                <p class="card-text">Manage all your listings</p>
            </div>
        </a>
        @endif
      
        </div>
       
      </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>
</html>