<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Jaygaa Dashboard</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/feathericon.min.css') }}">
    <link rel="stylehseet" href="https://cdn.oesmith.co.uk/morris-0.5.1.css">
    <link rel="stylesheet" href="{{ asset('assets/plugins/morris/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/reset.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/plugins.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/style2.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/color.css')}}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>

<body>
    <div class="main-wrapper">
    @include('admin.sidebar')
        <div class="page-wrapper">
			<div class="content container-fluid">
				
				<div class="page-header">
					
					<div class="row ">
						
						<div class="col">
							
							<h3 class="page-title mt-5">Listing Details</h3> 
						</div>
					</div>
				</div>

        
            
                <div class="row">
                    <div class="col-md-8">
                        <div class="list-single-main-wrapper fl-wrap text-center" id="sec2">
                           
                            <div class="list-single-main-media fl-wrap">
                                <div class="single-slider-wrapper fl-wrap">
                                    <div class="single-slider fl-wrap">
                                        <div class="slick-slide-item"><img src="{{ asset('assets/img/product/product-01.jpg') }}" alt=""></div>
                                        <div class="slick-slide-item"><img src="{{ asset('assets/img/product/product-01.jpg') }}" alt=""></div>
                                        <div class="slick-slide-item"><img src="{{ asset('assets/img/product/product-01.jpg') }}" alt=""></div>
                                    </div>
                                    <div class="swiper-button-prev sw-btn"><i class="fa fa-long-arrow-left"></i></div>
                                    <div class="swiper-button-next sw-btn"><i class="fa fa-long-arrow-right"></i></div>
                                </div>
                            </div>
                          
                            <div class="list-single-main-item fl-wrap">
                               
                                <div class="list-single-main-item-title fl-wrap">
                                    <h3>Amenities</h3>
                                </div>
                                <div class="listing-features fl-wrap">
                                    <ul>
                                        <li><i class="fa fa-rocket"></i> Elevator in building</li>
                                        <li><i class="fa fa-wifi"></i> Free Wi Fi</li>
                                        <li><i class="fa fa-motorcycle"></i> Free Parking</li>
                                        <li><i class="fa fa-cloud"></i> Air Conditioned</li>
                                        <li><i class="fa fa-shopping-cart"></i> Online Ordering</li>
                                        <li><i class="fa fa-paw"></i> Pet Friendly</li>
                                        <li><i class="fa fa-tree"></i> Outdoor Seating</li>
                                        <li><i class="fa fa-wheelchair"></i> Wheelchair Friendly</li>
                                    </ul>
                                </div>
                                <span class="fw-separator"></span>
                                <div class="list-single-main-item-title fl-wrap">
                                    <h3>Tags</h3>
                                </div>
                                <div class="list-single-tags tags-stylwrap">
                                    <a href="#">Event</a>
                                    <a href="#">Conference</a>
                                    <a href="#">Strategies</a>
                                    <a href="#">Trends</a>
                                    <a href="#">Schedule</a>
                                    <a href="#">Speak</a>
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
    <script type="text/javascript" src="{{asset('assets/js/plugins.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/scripts.js')}}"></script>
</body>
</html>