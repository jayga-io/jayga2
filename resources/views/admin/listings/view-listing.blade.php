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
            height: 500px;
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
                            <h3 class="page-title mt-3">Listing Details</h3>
                            <div class="page-title mt-3" style="float:right">
                                <a href="/admin/approve-listing/{{ $listing[0]->listing_id }}" class="btn btn-primary">Approve</a>
                                <a class="btn btn-danger" href="/admin/decline-listing/{{$listing[0]->listing_id }}">Decline</a>
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
                                <div class="carousel-container" style="width: 100%">
                                     @if (count($listing_images)>0)
                                        <div class="carousel">
                                            @foreach ($listing_images as $key => $item)
                                                <div class="carousel-slide"><img src="{{ asset('/uploads/'. $item->listing_targetlocation)}}" alt="Image" style="object-fit: contain"></div>
                                            @endforeach
                                        </div>
                                        <div class="carousel-controls">
                                            <div class="carousel-control mx-1" id="prevBtn">&lt; Previous</div>
                                            <div class="carousel-control mx-1" id="nextBtn">Next &gt;</div>
                                        </div>
                                    @else
                                        <p class="p-3 text-center">No listing image provided</p>
                                     @endif

                                </div>
 
                                <div class="card-body">
                                    <h5 class="card-title">Listing Title: {{ $listing[0]->listing_title }}</h5>
                                    <p class="card-text">Listing Address: {{ $listing[0]->listing_address }}</p>
                                    <a href="#" class="btn btn-primary">Price set by lister: {{ $listing[0]->full_day_price_set_by_user }}
                                        bdt/- per day</a>

                                    <p class="card-text mt-2">Listing Description: {{$listing[0]->listing_description}}</p>

                                    <div class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-4">Allow Short Stay {{$listing[0]->allow_short_stay == 1 ? '✔' : '❌' }}</div>
                                            <div class="col-md-4">Peaceful {{$listing[0]->describe_peaceful == 1 ? '✔' : '❌' }}</div>
                                            <div class="col-md-4">Unique {{$listing[0]->describe_unique == 1 ? '✔' : '❌' }}</div>
                                            <div class="col-md-4">Family Friendly {{$listing[0]->describe_familyfriendly == 1 ? '✔' : '❌' }}</div>
                                            <div class="col-md-4">Spacious {{$listing[0]->describe_spacious == 1 ? '✔' : '❌' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="list-group">
                                <div class="list-group-item">
                                    <p class="card-text py-2">Amenities</p>
                                   
                                </div>
                            </div>
                            
                            <div class="list-group-item">
                                @if (count($listing)>0)
                                <p class="card-text py-2">Describes</p>
                                <div class="list-group-item">
                                <div class="row">
                                    <div class="col"> {{ $listing[0]->listing_type }}</div>

                                </div>
                                </div>
                                @else
                                <p>No Describes Found</p>
                                @endif
                            </div>
                            
                            <div class="list-group-item">

                                <p>No restrictions found</p>
                            </div>

                            
                            

                        </div>
                    </div>
                
                    <div class="col-md-6">
                    <div class="container mt-5">
                        <div class="card">
                            @if (count($lister_image)>0)
                            <img src="{{ asset('/uploads/'. $lister_image[0]->user_targetlocation)}}"
                                class="card-img-top rounded-circle" style="width: 200px; height:200px; margin-left:20px" alt="Profile Image">
                            @else
                            <p class="p-3 text-center">No user image provided</p>
                            @endif

                            <div class="card-body">
                                @if (count($lister)>0)
                                    <h5 class="card-title">Lister name: {{ $lister[0]->name }}</h5>
                                @else
                                    <h6 class="card-title">Lister isn't registered yet</h6>
                                @endif
                                
                                
                            </div>
                            @if (count($lister)>0)
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Location: {{ $lister[0]->user_address === null ? 'No address provided' :
                                        $lister[0]->user_address }}</li>
                                    <li class="list-group-item">Email: {{ $lister[0]->email === null ? 'No email provided' : $lister[0]->email }}</li>
                                    <li class="list-group-item">Phone: {{ $lister[0]->phone }}</li>
                                    <li class="list-group-item">Joined: {{ $lister[0]->created_at->diffForHumans() }}</li>
                                </ul>
                            @else
                                <p class="card-text px-2">This listing has no user. created by admin</p>
                                
                            @endif
                            
                            <div class="card-body">
                               <p class="card-text py-2">Submitted Documents for listing</p>
                               <div class="carousel-container">
                                @if (count($lister_nid)>0)
                                   <div class="carousel">
                                       @foreach ($lister_nid as $key => $item)
                                           <div class="carousel-slide"><img src="{{ asset('/uploads/'. $item->nid_targetlocation)}}" alt="Image"></div>
                                       @endforeach
                                   </div>
                                   <div class="carousel-controls">
                                       <div class="carousel-control mx-1" id="prevBtn">&lt; Previous</div>
                                       <div class="carousel-control mx-1" id="nextBtn">Next &gt;</div>
                                   </div>
                               @else
                                   <p class="p-3 text-center">No documents provided</p>
                                @endif

                           </div>
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