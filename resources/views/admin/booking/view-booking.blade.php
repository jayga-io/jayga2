<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Jaygaa Dashboard</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/feathericon.min.css')}}">
    <link rel="stylehseet" href="https://cdn.oesmith.co.uk/morris-0.5.1.css">
    <link rel="stylesheet" href="{{asset('assets/plugins/morris/morris.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <style>
        .carousel-container {
            width: 100%;
            height: 300px;
            overflow: hidden;
            position: relative;
        }
        .carousel {
            width: 100%;
            display: flex;
            transition: transform 0.5s;
        }
        .carousel-slide {
            flex: 0 0 100%;
            height: 100%;
            width: 100%;
        }
        .carousel-controls {
            position: absolute;
            bottom: 10px;
            left: 0;
            right: 0;
            display: flex;
            justify-content: center;
        }
        .carousel-control {
            cursor: pointer;
            padding: 10px;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
        }
    </style>
</head>

<body>

    

    <div class="main-wrapper">

        @include('admin.sidebar')
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12 mt-5 ">
                            <h3 class="page-title mt-3">Booking Details</h3>
                            <div class="page-title mt-3" style="float:right">
                                <a class="btn btn-primary" href="/admin/approve-booking/{{$booking[0]->booking_id}}">Approve</a>
                                <a class="btn btn-danger" href="/admin/decline-booking/{{$booking[0]->booking_id}}">Decline</a>
                            </div>


                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active">Booking Id : {{ $booking[0]->booking_id }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="container mt-5">
                            <div class="card">
                                <div class="carousel-container">
                                     @if (count($user)>0)
                                        <div class="carousel">
                                            @foreach ($user as $key => $item)
                                                <div class="carousel-slide"><img src="{{ asset('/uploads/'. $item->user_nid_targetlocation)}}" alt="Image"></div>
                                            @endforeach
                                        </div>
                                        <div class="carousel-controls">
                                            <div class="carousel-control mx-1" id="prevBtn">&lt; Previous</div>
                                            <div class="carousel-control mx-1" id="nextBtn">Next &gt;</div>
                                        </div>
                                    @else
                                        <p class="p-3 text-center">No nid image provided</p>
                                     @endif

                                </div>
 
                                <div class="card-body">
                                    <h5 class="card-title">Booking name: {{ $booking[0]->booking_order_name }}</h5>
                                    <p class="card-text">Bookie email: {{ $booking[0]->email }}</p>
                                    <a href="#" class="btn btn-primary">Bookie phone: {{ $booking[0]->phone }}
                                        </a>

                                    <p class="card-text mt-2">Total guest numbers: {{$booking[0]->total_members }}</p>
                                    <p class="card-text mt-2">Check In Date: {{$booking[0]->date_enter }}</p>
                                    <p class="card-text mt-2">checkout date: {{$booking[0]->date_exit }}</p>
                                    
                                    
                                </div>
                            </div>

                        </div>
                    </div>
                
            </div>
        </div>
    </div>


    
    <script src="{{asset('assets/js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('assets/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('assets/plugins/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('assets/plugins/morris/morris.min.js')}}"></script>
    <script src="{{asset('assets/js/chart.morris.js')}}"></script>
    <script src="{{asset('assets/js/script.js')}}"></script>
    <script>
        const carousel = document.querySelector(".carousel");
        const slides = document.querySelectorAll(".carousel-slide");
        const prevBtn = document.getElementById("prevBtn");
        const nextBtn = document.getElementById("nextBtn");
        let currentIndex = 0;

        // Show the initial slide
        showSlide(currentIndex);

        // Function to display a slide by its index
        function showSlide(index) {
            if (index < 0) {
                index = slides.length - 1;
            } else if (index >= slides.length) {
                index = 0;
            }

            currentIndex = index;
            carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
        }

        // Event listeners for previous and next buttons
        prevBtn.addEventListener("click", () => {
            showSlide(currentIndex - 1);
        });

        nextBtn.addEventListener("click", () => {
            showSlide(currentIndex + 1);
        });
    </script>
    
</body>

</html>