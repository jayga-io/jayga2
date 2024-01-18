<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jayga | Listing Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .checked {
            color: orange;
        }

        #share {
            text-align: right;
        }

        #product-img {
           
            object-fit: contain;
            border-radius: 27px;
            width: 100%;
            height: 500px;
        }

        .col {
            padding: 3px;
        }

        .col-3 {
            padding: 5px;
            margin: 3px;
        }

        @media (max-width:600px) {

            #share {
                text-align: left;
            }

            
            #host_desc{
                display: none;
            }
        }


        .heading {
            font-size: 25px;
            margin-right: 25px;
        }

        .fa {
            font-size: 25px;
        }

        .checked {
            color: orange;
        }

        /* Three column layout */
        .side {
            float: left;
            width: 15%;
            margin-top: 10px;
        }

        .middle {
            margin-top: 10px;
            float: left;
            width: 70%;
        }

        /* Place text to the right */
        .right {
            text-align: right;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        /* The bar container */
        .bar-container {
            width: 100%;
            background-color: #f1f1f1;
            text-align: center;
            color: white;
        }

        /* Individual bars */
        .bar-5 {
            width: 60%;
            height: 18px;
            background-color: #04AA6D;
        }

        .bar-4 {
            width: 30%;
            height: 18px;
            background-color: #04AA6D;
        }

        .bar-3 {
            width: 10%;
            height: 18px;
            background-color: #04AA6D;
        }

        .bar-2 {
            width: 4%;
            height: 18px;
            background-color: #04AA6D;
        }

        .bar-1 {
            width: 15%;
            height: 18px;
            background-color: #04AA6D;
        }

        /* Responsive layout - make the columns stack on top of each other instead of next to each other */
        @media (max-width: 400px) {

            .side,
            .middle {
                width: 100%;
            }

            .right {
                display: none;
            }
        }

        .card {
            box-shadow: #158E72;
        }
    </style>

    <style>
        div.scroll-container {
            background-color: #333;
            overflow: auto;
            white-space: nowrap;
            padding: 10px;
        }

        div.scroll-container img {
            padding: 2px;
        }
        
    </style>



</head>

<body>
    <!--Navbar Section-->
    <nav class="navbar navbar-expand-lg bg-body-tertiary mb-5">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03"
                aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#"> <img class="px-3" style="float: right;"
                    src="../public/assets/img/logo/Jayga Logo-02.png" width="120" height="100" alt="logo" /></a>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                </ul>
                <ul class="navbar-nav mb-lg-0">
                    <li class="nav-item mx-3">
                        <a class="nav-link" aria-current="page" href="#">Services</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="#">List your property</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link "><img src="../public/assets/img/globe.png" alt="" srcset=""> EN</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <button
                                style="width: 100%; height: 100%; padding-top: 4px; padding-bottom: 4px; padding-left: 28px; padding-right: 29.80px; border-radius: 4.99px; overflow: hidden; border: 0.87px rgba(21, 142, 114, 0.66) solid; justify-content: center; align-items: center; display: inline-flex">
                                <div
                                    style="color: #158E72; font-size: 16.58px; font-family: Montserrat; font-weight: 500; word-wrap: break-word">
                                    Sign Up
                                </div>
                            </button>
                        </a>

                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <div
                                style="width: 100%; height: 100%; padding-top: 4px; padding-bottom: 4px; padding-left: 35.80px; padding-right: 36px; background: #158E72; border-radius: 4.99px; overflow: hidden; justify-content: center; align-items: center; display: inline-flex">
                                <div
                                    style="color: white; font-size: 16.58px; font-family: Montserrat; font-weight: 500; word-wrap: break-word">
                                    Log In
                                </div>
                            </div>
                        </a>

                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!--Listing title-->
    <div class="container ">
        <div class="row">
            <div class="col-md-12">
                <h1 class="card-title">{{$listing[0]->listing_title}}</h1>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6 p-2">
                @if (count($listing[0]->reviews)>0)
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="px-2">{{count($listing[0]->reviews)}} Reviews</span>
                    <span>Dhaka, Bangladesh</span>
                @else
                    <div class="card-text">No reviews yet</div>
                @endif
                

            </div>
            <div class="col-md-6 p-2" id="share">
                <span class="px-2"><i class="fa fa-heart-o" onclick="say()" id="sy"></i> Save</span>
                <span class="px-2"><i class="fa fa-share-alt" aria-hidden="true"></i> Share</span>
            </div>
        </div>

        <!--Image banner-->

        <div class="row mb-3">
            <div class="scroll-container">
                @foreach ($listing[0]->images as $item)

                   
                        <a href="https://new.jayga.io/uploads/{{$item->listing_targetlocation}}" data-toggle="lightbox" data-gallery="example-gallery" class="col-sm-4">
                            <img src="https://new.jayga.io/uploads/{{ $item->listing_targetlocation}}" class="img-fluid mx-1">
                        </a>
                   
                    
                @endforeach
            </div>
           
            
            
        </div>

        <!--description-->

        <div class="row justify-content-between">
            <div class="col-md-7 ">
                <h2 class="card-title mb-3">Description</h2>
                <p>{{$listing[0]->guest_num}} Guests <span>{{$listing[0]->bed_num}} bedrooms</span> <span>{{$listing[0]->bed_num}} beds</span> <span>{{$listing[0]->bathroom_num}} baths</span></p>
                <hr>
                <div class="card-body mt-5">
                    {{$listing[0]->description}}
                </div>
                <hr>
                <div class="card-body mt-5 d-flex justify-content-between">
                    <h2 class="card-title mb-5">
                        What this place offers
                    </h2>
                    <a href="#">Show All</a>
                </div>
                <!--Amenities-->
                <div class="card-body mb-3">
                    <div class="row row-cols-2 mb-5">
                        @foreach ($amenities as $item)
                            <div class="col-3 ">
                                <button class="btn btn-success ">{{Str::upper($item)}}</button>
                            </div>
                        @endforeach
                        
                       
                    </div>
                </div>
                <hr>
                <!--Jayga Protect-->
                <div class="card-body py-3 mb-2">
                    <div class="mt-3">
                        <span
                            style="color: #139175; font-size: 32px; font-weight: 700; word-wrap: break-word">Jayga
                        </span>
                        <span
                            style="color: black; font-size: 28.85px; font-family: Montserrat; font-weight: 500; word-wrap: break-word">
                        </span>
                        <span
                            style="color: black; font-size: 32px;  font-weight: 500; word-wrap: break-word">Protect  <span><img src="{{asset('assets/img/verified-fill.png')}}" class="p-2" alt=""></span>
                        </span>
                           
                    </div>
                    <div class="py-3 mb-4"
                        style="width: 100%; height: 100%; color: black; font-size: 23.08px; font-weight: 300; word-wrap: break-word">
                        Every booking includes free protection from Host cancellations, listing inaccuracies, and other
                        issues like trouble checking in.</div>
                </div>
                <hr>

            </div>
            <div class="col-md-4 ">
                <div class="card px-2" style="width: 100%; height: 100%; border-radius: 25px;">
                    <div class="container">
                        <div class="d-flex justify-content-between  my-5">
                            <h2 class="card-title ">
                               <span id="price">{{$listing[0]->full_day_price_set_by_user}}</span><span id="updatePrice"></span> BDT <span class="fs-6" id="slot">Per day</span>
                            </h2>
                            <div>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <div>
                                    {{count($listing[0]->reviews)}} Reviews
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="card" style="box-sizing: border-box;">
                                    <!--Short stay slot-->
                                    
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                          <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne" id="short_stay_button">
                                                <input type="hidden" value="0" name="short_stay" >
                                                <input type="checkbox" value="1" name="short_stay" id="short_stay_check" onchange="doprice(this)">
                                                <span class="mx-2">Short Stay</span>
                                            </button>
                                          </h2>
                                          <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <div class="row ">
                                                    <div class="col-12 col-sm-12 justify-content-between">


                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <input type="hidden" value="0"
                                                                    name="short_stay_slot">
                                                                <input type="checkbox" value="1"
                                                                    name="short_stay_slot" id="s1">
                                                                <span class="px-2">Slot 1</span>
                                                            </div>


                                                            <span>12:00 PM - 04:00PM</span>


                                                        </div>

                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <input type="hidden" value="0" name="short_stay_slot">
                                                            <input type="checkbox" value="1" name="short_stay_slot" id="s2">
                                                            <span class="px-2">Slot 2</span>
                                                        </div>


                                                        <span>12:00 PM - 04:00PM</span>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <input type="hidden" value="0" name="short_stay_slot">
                                                            <input type="checkbox" value="1" name="short_stay_slot" id="s3">
                                                            <span class="px-2">Slot 3</span>
                                                        </div>


                                                        <span>12:00 PM - 04:00PM</span>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                        
                                      </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex justify-content-between py-5">
                                        <div class="input-group">
                                            <div class="form-floating">
                                                <input type="date" class="form-control"
                                                    style=" font-weight: 700; font-size: 17px;"
                                                    id="floatingInput">
                                                <label for="floatingInput" style="font-weight: 500;">Check In</label>
                                            </div>
                                            <div class="form-floating">
                                                <input type="date" class="form-control"
                                                    style="font-weight: 700; font-size: 17px;"
                                                    id="floatingInput">
                                                <label for="floatingInput" style="font-weight: 500;">Check Out</label>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="my-3 mx-2">
                                        <p class="text-dark">Guests</p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="card-text">Adult</div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group py-2">
                                           
                                                    <input type="button" value="-"
                                                        class="button-minus border rounded-circle  icon-shape icon-sm mx-1 "
                                                        data-field="quantity">
                                                    <input type="number" step="1" max="10" value="1" name="quantity"
                                                        class="quantity-field border-0 text-center w-25">
                                                    <input type="button" value="+"
                                                        class="button-plus border rounded-circle icon-shape icon-sm "
                                                        data-field="quantity">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="card-text">Children</div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group py-2">
                                           
                                                    <input type="button" value="-"
                                                        class="button-minus border rounded-circle  icon-shape icon-sm mx-1 "
                                                        data-field="quantity">
                                                    <input type="number" step="1" max="10" value="1" name="quantity"
                                                        class="quantity-field border-0 text-center w-25">
                                                    <input type="button" value="+"
                                                        class="button-plus border rounded-circle icon-shape icon-sm "
                                                        data-field="quantity">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="card-text">Pets</div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group py-2">
                                           
                                                    <input type="button" value="-"
                                                        class="button-minus border rounded-circle  icon-shape icon-sm mx-1 "
                                                        data-field="quantity">
                                                    <input type="number" step="1" max="10" value="1" name="quantity"
                                                        class="quantity-field border-0 text-center w-25">
                                                    <input type="button" value="+"
                                                        class="button-plus border rounded-circle icon-shape icon-sm "
                                                        data-field="quantity">
                                                </div>
                                            </div>
                                        </div>

                                        
                                    </div>
                                </div>



                                <hr>
                                <div class="container d-flex justify-content-between mb-5" >
                                    
                                        <div id="slot_name">Slot </div>
                                        <span id="slot_no">1</span>
                                    
                                    
                                    
                                </div>
                                <div class="container  d-flex justify-content-between">
                                    <div>Jayga Fee </div>
                                    <span>3%</span>
                                </div>
                                <hr>
                                <div class="container p-3 d-flex justify-content-between">
                                    <div style="font-size: 24px; font-weight: 700;">Total </div>
                                   
                                    <span style="font-size: 32px; font-weight: 700;" id="pay_amount">5500</span>
                                </div>
                                <div class="my-3">
                                    <button class="form-control btn btn-success p-3" style="border-radius: 25px;">Book
                                        Now</button>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-md-7 col-sm-12">
                <div class="card-body mt-5">
                    <span class="heading">Reviews</span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>

                    @if (count($listing[0]->reviews)>0)
                        <div class="review">
                            <div class="d-flex justify-content-between">
                                <p class="card-title" style="font-size: larger; font-weight: 700;">{{$listing[0]->reviews[0]->avg_rating}} |</p>
                                <span><a href="#">Show all reviews</a></span>
                            </div>

                            <hr style="border:3px solid #f1f1f1">

                            <div class="row">
                                <div class="side">
                                    <div>5 star</div>
                                </div>
                                <div class="middle">
                                    <div class="bar-container">
                                        <div class="bar-5"></div>
                                    </div>
                                </div>
                                <div class="side right">
                                    <div>150</div>
                                </div>
                                <div class="side">
                                    <div>4 star</div>
                                </div>
                                <div class="middle">
                                    <div class="bar-container">
                                        <div class="bar-4"></div>
                                    </div>
                                </div>
                                <div class="side right">
                                    <div>63</div>
                                </div>
                                <div class="side">
                                    <div>3 star</div>
                                </div>
                                <div class="middle">
                                    <div class="bar-container">
                                        <div class="bar-3"></div>
                                    </div>
                                </div>
                                <div class="side right">
                                    <div>15</div>
                                </div>
                                <div class="side">
                                    <div>2 star</div>
                                </div>
                                <div class="middle">
                                    <div class="bar-container">
                                        <div class="bar-2"></div>
                                    </div>
                                </div>
                                <div class="side right">
                                    <div>6</div>
                                </div>
                                <div class="side">
                                    <div>1 star</div>
                                </div>
                                <div class="middle">
                                    <div class="bar-container">
                                        <div class="bar-1"></div>
                                    </div>
                                </div>
                                <div class="side right">
                                    <div>20</div>
                                </div>
                            </div> 
                        </div>
                    @else
                        <div class="review">
                            No Reviews Yet
                        </div>
                    @endif
                    
                    

                </div>
            </div>
        </div>
        <hr>
        <!--location-->

        <!--Need to be done-->

        <!--Host details-->
        <div class="row my-5">
            <div class="d-flex justify-content-between mb-5">
                <div class="col-md-6 col-sm-12 d-flex">
                    @if ($listing[0]->host->avatars)
                       <img src="{{asset('/uploads/'. $listing[0]->host->avatars->user_targetloction)}}" class="rounded-circle" style="width: 120px; height: 120px;" alt="">
                       
                    @else
                         <img src="{{asset('assets/img/user_with_no_profile_picture.png')}}" class="rounded-circle" style="width: 120px; height: 120px;" alt="" srcset="">
                    @endif
                    
                    <div class="container mx-5">
                        <div style="width: 100%;  color: #838383; font-size: 18px;  font-weight: 300;  word-wrap: break-word">Hosted by</div>
                        <div class="card-title" style="font-size: 32px; font-weight: 500;">
                           {{$listing[0]->host->name}}
                        </div>
                        <div class="py-3">
                            <i class="fa fa-star checked"></i>
                            <span>15 Host Reviews</span>
                        </div>
                        <div >
                            <i class="fa fa-user" style="color: #09CA9C;"></i>
                            <span class="px-2">Identity Verified</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" id="host_desc">
                    @if ($listing[0]->host->about)
                        <div class="card-text">
                            {{$listing[0]->host->about}}
                        </div>
                    @else
                        <div class="card-text">
                            I am a traveler myself 7 want to help fellow travelers to find the best experiences in Bangladesh. That is why I started a venture to make people discover the hidden beauties & experiences in Bangladesh. I find local tourism entrepreneurs who are doing excellent jobs but cannot produce a profitable business. I work hand in hand with local tourism entrepreneurs to provide the best experiences to travelers...
                        </div>
                    @endif
                    
                </div>
            </div>

            
        </div>
        <hr>
        <!--Host Policies-->
        <div class="row">
            <div class="accordion accordion-flush" id="accordionExample">
                <div class="accordion-item my-3">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      <span style="font-size: 20px; font-weight: 500">Host Restrictions</span>
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="row row-cols-2 mb-3">
                            @foreach ($restrictions as $item)
                                <div class="col-3 ">
                                    <button class="btn btn-success ">{{Str::upper($item)}}</button>
                                </div>
                            @endforeach
                            
                            
                        </div>
                    </div>
                  </div>
                </div>
                <div class="accordion-item my-3">
                  <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <span style="font-size: 20px; font-weight: 500">Availability Check</span>
                    </button>
                  </h2>
                  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      Coming Soon...
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <span style="font-size: 20px; font-weight: 500">Cancelation Policies</span>
                    </button>
                  </h2>
                  <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                     Coming Soon...
                    </div>
                  </div>
                </div>
              </div>
        </div>

        <!--Report-->
        <div class="row mb-3">
            <div class="col-12">
                <div class="d-flex m-3 p-3">
                    <i class="fa fa-flag" style="color: #F24E1E;"></i>
                    <span class="px-2">Report this posting</span>
                </div>
            </div>
        </div>

        <hr>

         <!--Footer-->
         <div class="container">

            <div class="row  my-3 align-items-center">
                
                <div class="col-md-3 col-lg-3 col-sm-12 px-2">
                    <img src="../public/assets/img/logo/Jayga Logo-02.png" width="80" height="80" alt="Jayga">
                    <div style="width: 100%; color: black; font-size: 15px;  font-weight: 400; word-wrap: break-word">
                        Bangladesh’s first peer to peer technology enabled spacing solution platform</div>

                </div>
                <div class="col-md-3 col-lg-3 col-sm-12 mt-5 px-2">
                    <h6><strong>Explore</strong></h6>
                    <ul>
                        <li>Jayga Maps</li>
                        <li>Community</li>
                        <li>Listings</li>
                    </ul>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-12 mt-5 px-2">
                    <h6><strong>Company</strong></h6>
                    <ul>
                        <li>About Us</li>
                        <li>Privacy Policy</li>
                        <li>Terms & Conditions</li>
                    </ul>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-12 mt-5 px-2">
                    <h6><strong>Information</strong></h6>
                    <ul>
                        <li>FAQ</li>
                        <li>Services</li>
                        <li>Booking & Payment</li>
                    </ul>
                </div>

            </div>
            <hr>
            <div class="row">
                <div class="col-md-12 text-center">
                    <p>&copy; Jayga 2024. <span>All Rights Reserved.</span></p>
                </div>

            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>
    <script>
        function say() {
            var el = document.querySelector('#sy');
            if (el.classList[1] == 'fa-heart-o') {
                el.classList.remove('fa');
                el.classList.remove('fa-heart-o');
                el.classList.add('fa');
                el.classList.add('fa-heart');
            } else if (el.classList[1] == 'fa-heart') {
                el.classList.remove('fa');
                el.classList.remove('fa-heart');
                el.classList.add('fa');
                el.classList.add('fa-heart-o');
            }

        }
    </script>

    <script>
        var short_stay = document.getElementById('short_stay_button');
        var short_stay_select = document.getElementById('short_stay_check');
        var s1 = document.getElementById('s1');
        var s2 = document.getElementById('s2');
        var s3 = document.getElementById('s3');
        var price = document.getElementById('price');
        var perday = document.getElementById('slot');
       var slot_no = document.getElementById('slot_no');
       var pay = document.getElementById('pay_amount');
       var pay_old = document.getElementById('pay_old');
        
        short_stay.addEventListener('click', function(){
           if(short_stay_select.hasAttribute('checked')){
            short_stay_select.removeAttribute('checked');
           
           }else{
            short_stay_select.setAttribute('checked', true);
            
           }
        });

        function doprice(element){
            if(element.checked){
                
                price.style.display = 'none';
                priceUpdate.style.display = 'block';
               

            }else{
                price.style.display = 'block';
                priceUpdate.style.display = 'none';
                
            }
        }

        
        var whole_day_price = parseInt(price.textContent);
        var priceUpdate = document.getElementById('updatePrice');
        priceUpdate.style.display = 'none';

        s1.addEventListener('change', function(){
            s1.toggleAttribute('checked');
            s2.toggleAttribute('disabled');
            s3.toggleAttribute('disabled');
           
            if(s1.hasAttribute('checked')){
                var calc_price = ((whole_day_price*40)/100);
                var new_price = whole_day_price + calc_price;
                var update_price = new_price*(1/4);
                priceUpdate.innerText = update_price;
                var commision = (whole_day_price*3)/100;
                perday.innerText = 'per slot';
                price.style.display = 'none';
                priceUpdate.style.display = 'block';
                slot_no.innerText = '1';
                pay.innerText = update_price + commision;
               

            }else{
                var commision = (whole_day_price*3)/100;
                perday.innerText = 'per day';
                price.style.display = 'block';
                priceUpdate.style.display = 'none';
                slot_no.innerText = '0';
                pay.innerText = whole_day_price + commision;
            }
            
            



            
            
            
        });

        s2.addEventListener('click', function(){
            s1.toggleAttribute('disabled');
            s2.toggleAttribute('checked');
            s3.toggleAttribute('disabled');
            if(s2.hasAttribute('checked')){
                var calc_price = ((whole_day_price*40)/100);
                var new_price = whole_day_price + calc_price;
                var update_price = new_price*(1/4);
                priceUpdate.innerText = update_price;
                var commision = (whole_day_price*3)/100;
                perday.innerText = 'per slot';
                price.style.display = 'none';
                priceUpdate.style.display = 'block';
                slot_no.innerText = '2';
                pay.innerText = update_price + commision;
            }else{
                var commision = (whole_day_price*3)/100;
                perday.innerText = 'per day';
                price.style.display = 'block';
                priceUpdate.style.display = 'none';
                slot_no.innerText = '0';
                pay.innerText = whole_day_price + commision;
            }
        });

        s3.addEventListener('click', function(){
            s1.toggleAttribute('disabled');
            s2.toggleAttribute('disabled');
            s3.toggleAttribute('checked');
            if(s3.hasAttribute('checked')){
                var calc_price = ((whole_day_price*40)/100);
                var new_price = whole_day_price + calc_price;
                var update_price = new_price*(2/4);
                priceUpdate.innerText = update_price;
                var commision = (whole_day_price*3)/100;
                perday.innerText = 'per slot';
                price.style.display = 'none';
                priceUpdate.style.display = 'block';
                slot_no.innerText = '3';
                pay.innerText = update_price + commision;
            }else{
                var commision = (whole_day_price*3)/100;
                perday.innerText = 'per day';
                price.style.display = 'block';
                priceUpdate.style.display = 'none';
                slot_no.innerText = '0';
                pay.innerText = whole_day_price + commision;
            }
        });

        
    </script>

    <script>
        function incrementValue(e) {
            e.preventDefault();
            var fieldName = $(e.target).data('field');
            var parent = $(e.target).closest('div');
            var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

            if (!isNaN(currentVal)) {
                parent.find('input[name=' + fieldName + ']').val(currentVal + 1);
            } else {
                parent.find('input[name=' + fieldName + ']').val(0);
            }
        }

        function decrementValue(e) {
            e.preventDefault();
            var fieldName = $(e.target).data('field');
            var parent = $(e.target).closest('div');
            var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

            if (!isNaN(currentVal) && currentVal > 0) {
                parent.find('input[name=' + fieldName + ']').val(currentVal - 1);
            } else {
                parent.find('input[name=' + fieldName + ']').val(0);
            }
        }

        $('.input-group').on('click', '.button-plus', function (e) {
            incrementValue(e);
        });

        $('.input-group').on('click', '.button-minus', function (e) {
            decrementValue(e);
        });

    </script>
</body>

</html>