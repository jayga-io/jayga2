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
        /* Add your CSS styles here */
        .slider {
            width: 100%;
            overflow: hidden;
            margin: 0 auto;
        }

        .slider img {
            width: 100%;
            height: auto;
            display: none;
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
								<li class="breadcrumb-item active">Dashboard</li>
							</ul>
						</div>
					</div>
				</div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="container mt-5">
                            <div class="card">
                                @if (count($listing_images)>0)
                                    <!-- Carousel -->
                                    <div class="slider">
                                        @foreach ($listing_images as $key => $item)
                                                
                                                    <img src="{{ asset('/uploads/'. $item->listing_targetlocation)}}" alt="Image 1">
                                                 
                                            @endforeach
                                    </div>
                                    
                                           
                                            
                                           
                                        
                                    
                                @else
                                    <p class="p-3 text-center">No listing image provided</p>
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $listing[0]->listing_title }}</h5>
                                    <p class="card-text">{{ $listing[0]->listing_address }}</p>
                                    <a href="#" class="btn btn-primary">{{ $listing[0]->full_day_price_set_by_user }} TK/- Per Day</a>
                                </div>
                            </div>
                            <p class="card-text">Amenities</p>
                            <div class="list-group">
                                <div class="list-group-item">
                                    @if (count($amenities)>0)
                                        @foreach ($amenities as $item)
                                            <div class="row">
                                                <div class="col">{{$item}}</div>
                                                
                                            </div>
                                        @endforeach
                                    @else
                                        <p>No amenities found</p>
                                    @endif
                                    
                                </div>
                                <div class="list-group-item">
                                    <div class="row">
                                        <div class="col">Item 5</div>
                                        <div class="col">Item 6</div>
                                        <div class="col">Item 7</div>
                                        <div class="col">Item 8</div>
                                    </div>
                                </div>
                                <div class="list-group-item">
                                    <div class="row">
                                        <div class="col">Item 9</div>
                                        <div class="col">Item 10</div>
                                        <div class="col">Item 11</div>
                                        <div class="col">Item 12</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="container mt-5">
                            <div class="card">
                                @if (count($lister_image)>0)
                                    <img src="{{ asset('/uploads/'. $lister_image[0]->user_targetlocation)}}" class="card-img-top" alt="Profile Image">
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
        // JavaScript for the image slider
        const slider = document.querySelector('.slider');
        const images = slider.querySelectorAll('img');
        let currentImage = 0;
    
        function nextImage() {
            images[currentImage].style.display = 'none';
            currentImage = (currentImage + 1) % images.length;
            images[currentImage].style.display = 'block';
        }
    
        function prevImage() {
            images[currentImage].style.display = 'none';
            currentImage = (currentImage - 1 + images.length) % images.length;
            images[currentImage].style.display = 'block';
        }
    
        // Automatic slideshow
        setInterval(nextImage, 3000); // Change image every 3 seconds
    </script>
</body>
</html>