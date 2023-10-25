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
                            <h3 class="page-title mt-3">Listing Details</h3>
                            <div class="page-title mt-3" style="float:right">
                                <button class="btn btn-primary">Approve</button>
                                <button class="btn btn-danger">Decline</button>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active">Listing Id : {{ $listing[0]->listing_id }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="container mt-5">
                            <div class="card">
                                <div class="carousel-container">
                                     @if (count($listing_images)>0)
                                        <div class="carousel">
                                            @foreach ($listing_images as $key => $item)
                                                <div class="carousel-slide"><img src="{{ asset('/uploads/'. $item->listing_targetlocation)}}" alt="Image"></div>
                                            @endforeach
                                        </div>
                                        <div class="carousel-controls">
                                            <div class="carousel-control" id="prevBtn">&lt; Previous</div>
                                            <div class="carousel-control" id="nextBtn">Next &gt;</div>
                                        </div>
                                    @else
                                        <p class="p-3 text-center">No listing image provided</p>
                                     @endif

                                </div>
 
                                <div class="card-body">
                                    <h5 class="card-title">{{ $listing[0]->listing_title }}</h5>
                                    <p class="card-text">{{ $listing[0]->listing_address }}</p>
                                    <a href="#" class="btn btn-primary">{{ $listing[0]->full_day_price_set_by_user }}
                                        TK/- Per Day</a>
                                </div>
                            </div>
                            <p class="card-text">Amenities</p>
                            <div class="list-group">
                                <div class="list-group-item">
                                    @if (count($amenities)>0)
                                    <div class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-4">Free Wifi {{ $amenities[0]->wifi == 1 ? '✔' : 'X' }}</div>
                                            <div class="col-md-4">TV {{ $amenities[0]->wifi == 1 ? '✔' : 'X' }}</div>
                                            <div class="col-md-4">Kitchen {{ $amenities[0]->wifi == 1 ? '✔' : 'X' }}</div>
                                            <div class="col-md-4">Washing Machine {{ $amenities[0]->wifi == 1 ? '✔' : 'X' }}
                                            </div>
                                            <div class="col-md-4">Free Parking {{ $amenities[0]->wifi == 1 ? '✔' : 'X' }}
                                            </div>
                                            <div class="col-md-4">Dedicated Workspace {{ $amenities[0]->wifi == 1 ? '✔' : 'X'
                                                }}</div>
                                            <div class="col-md-4">Pool {{ $amenities[0]->wifi == 1 ? '✔' : 'X' }}</div>
                                            <div class="col-md-4">Hot tub {{ $amenities[0]->wifi == 1 ? '✔' : 'X' }}</div>
                                            <div class="col-md-4">BBQ Grill {{ $amenities[0]->wifi == 1 ? '✔' : 'X' }}</div>
                                            <div class="col-md-4">Patio {{ $amenities[0]->wifi == 1 ? '✔' : 'X' }}</div>
                                            <div class="col-md-4">Outdooring {{ $amenities[0]->wifi == 1 ? '✔' : 'X' }}</div>
                                            <div class="col-md-4">Fire Pit {{ $amenities[0]->wifi == 1 ? '✔' : 'X' }}</div>
                                            <div class="col-md-4">Gym {{ $amenities[0]->wifi == 1 ? '✔' : 'X' }}</div>
                                            <div class="col-md-4">Beach Access {{ $amenities[0]->wifi == 1 ? '✔' : 'X' }}
                                            </div>
                                            <div class="col-md-4">Breakfast Included {{ $amenities[0]->wifi == 1 ? '✔' : 'X'
                                                }}</div>
                                            <div class="col-md-4">Air Condition {{ $amenities[0]->wifi == 1 ? '✔' : 'X' }}
                                            </div>
                                            <div class="col-md-4">Smoke Alarm {{ $amenities[0]->wifi == 1 ? '✔' : 'X' }}
                                            </div>
                                            <div class="col-md-4">FirstAid {{ $amenities[0]->wifi == 1 ? '✔' : 'X' }}</div>
                                            <div class="col-md-4">Fire exting. {{ $amenities[0]->wifi == 1 ? '✔' : 'X' }}
                                            </div>
                                            <div class="col-md-4">CCTV {{ $amenities[0]->wifi == 1 ? '✔' : 'X' }}</div>


                                        </div>
                                    </div>


                                    @else
                                    <p>No amenities found</p>
                                    @endif
                                </div>
                            </div>

                            <div class="list-group-item">
                                @if (count($listing)>0)
                                <div class="row">
                                    <div class="col">Listing Describes: {{ $listing[0]->listing_type }}</div>

                                </div>
                                @else
                                <p>No Describes Found</p>
                                @endif
                            </div>
                            <p class="card-text">Restrictions</p>
                            <div class="list-group-item">

                                @if (count($restrictions)>0)
                                <div class="list-group-items">
                                    <div class="row">
                                        <div class="col-md-4">Indoor Smoking {{ $restrictions[0]->indoor_smoking == 1 ? '✔' :
                                            'X' }}</div>
                                        <div class="col-md-4">Party {{ $restrictions[0]->party == 1 ? '✔' : 'X' }}</div>
                                        <div class="col-md-4">Pets {{ $restrictions[0]->pets == 1 ? '✔' : 'X' }}</div>
                                        <div class="col-md-4">Late Night Entry {{ $restrictions[0]->late_night_entry == 1 ?
                                            '✔' : 'X' }}</div>
                                        <div class="col-md-4">Additional Guest Entry {{ $restrictions[0]->unknown_guest_entry
                                            == 1 ? '✔' : 'X' }}</div>
                                        <div class="col-md-4">Specific Requirements {{ $restrictions[0]->specific_requirement
                                            ? $restrictions[0]->specific_requirement : 'No Requirement provided' }}
                                        </div>

                                    </div>
                                </div>
                                @else
                                <p>No Restrictions Provided</p>
                                @endif
                            </div>

                        </div>
                    </div>
                
                <div class="col-md-6">
                    <div class="container mt-5">
                        <div class="card">
                            @if (count($lister_image)>0)
                            <img src="{{ asset('/uploads/'. $lister_image[0]->user_targetlocation)}}"
                                class="card-img-top" alt="Profile Image">
                            @else
                            <p class="p-3 text-center">No user image provided</p>
                            @endif

                            <div class="card-body">
                                <h5 class="card-title">John Doe</h5>
                                <p class="card-text">Web Developer</p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Location: New York, USA</li>
                                <li class="list-group-item">Email: john@example.com</li>
                                <li class="list-group-item">Phone: (123) 456-7890</li>
                            </ul>
                            <div class="card-body">
                                <a href="#" class="card-link">Website</a>
                                <a href="#" class="card-link">LinkedIn</a>
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