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
	<link rel="stylesheet" href="{{asset('assets/css/style.css')}}"> </head>

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
                                <div id="imageCarousel" class="carousel slide" data-ride="carousel">
                                    @foreach ($listing_images as $key => $item)
                                        <ol class="carousel-indicators">
                                            <li data-target="#imageCarousel" data-slide-to="{{ $key }}" class="active"></li>
                                            
                                        </ol>
                                    @endforeach
                                    
                                   
                                    <div class="carousel-inner">
                                        @foreach ($listing_images as $item)
                                            <div class="carousel-item">
                                                <img src="{{ public_path(). $item->listing_targetlocation }}" class="d-block w-100" alt="Image 1">
                                            </div>
                                        @endforeach
                                        
                                       
                                    </div>
                                    <a class="carousel-control-prev" href="#imageCarousel" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#imageCarousel" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Card Title</h5>
                                    <p class="card-text">Some quick example text to build on the card's content.</p>
                                    <a href="#" class="btn btn-primary">Learn More</a>
                                </div>
                            </div>
                            <p class="card-text">Some quick example text to build on the card's content.</p>
                            <div class="list-group">
                                <div class="list-group-item">
                                    <div class="row">
                                        <div class="col">Item 1</div>
                                        <div class="col">Item 2</div>
                                        <div class="col">Item 3</div>
                                        <div class="col">Item 4</div>
                                    </div>
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
                                <img src="profile-image.jpg" class="card-img-top" alt="Profile Image">
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
</body>
</html>