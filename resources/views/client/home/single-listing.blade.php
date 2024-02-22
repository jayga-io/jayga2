<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <title>Jayga | Listing Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Epilogue">
    <style>
        .checked {
            color: orange;
        }

        #share {
            text-align: right;
        }

        body::-webkit-scrollbar {
            display: none;
        }

        body {
            font-family: "Epilogue";
            overflow-x: hidden;
        }

        #product-img {

            object-fit: contain;
            border-radius: 27px;
            width: 600px;
            height: 500px;
            margin: 0px;
        }

        .col {
            padding: 3px;
        }

        .col-3 {
            padding: 5px;
            margin: 3px;
        }

        .daterangepicker td.disabled {
            color: #f9f7f7;
            font-weight: 900;
            background-color: #F24E1E;
        }



        @media (max-width:600px) {

            #share {
                text-align: left;
            }


            #host_desc {
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


        #myBtn {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Fixed/sticky position */
            bottom: 20px;
            /* Place the button at the bottom of the page */
            right: 30px;
            /* Place the button 30px from the right */
            z-index: 99;
            /* Make sure it does not overlap */
            border: none;
            /* Remove borders */
            outline: none;
            /* Remove outline */
            background-color: #158E72;
            /* Set a background color */
            color: white;
            /* Text color */
            cursor: pointer;
            /* Add a mouse pointer on hover */
            padding: 15px;
            /* Some padding */
            border-radius: 10px;
            /* Rounded corners */
            font-size: 18px;
            /* Increase font size */
        }

        #myBtn:hover {
            background-color: #555;
            /* Add a dark-grey background on hover */
        }
    </style>

    <style>
        div.scroll-container {
            background-color: #fffefe;
            overflow: auto;
            white-space: nowrap;
            padding: 2px;
        }
    </style>



</head>

<body>
    <!--Navbar Section-->
    @include('navbar')

    <!--Listing title-->
    <div class="container ">
        <div class="row mt-5">
            <div class="col-md-12">
                <h1 class="card-title">{{ $listing[0]->listing_title }}</h1>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6 p-2">
                @if (count($listing[0]->reviews) > 0)
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="px-2">{{ count($listing[0]->reviews) }} Reviews</span>
                    <span>Dhaka, Bangladesh</span>
                @else
                    <div class="card-text mx-2">No reviews yet</div>
                @endif


            </div>
            <div class="col-md-6 p-2" id="share">
                <span class="px-2"><i class="fa fa-heart-o" onclick="say()" id="sy"></i> Save</span>
                <span class="px-2"><i class="fa fa-share-alt" aria-hidden="true"></i> Share</span>
            </div>
        </div>

        <!--Image banner-->

        <div class="row mb-3">
            <div class="scroll-container" style="margin: 0">
                @foreach ($listing[0]->images as $item)
                    <a href="https://new.jayga.io/uploads/{{ $item->listing_targetlocation }}" data-toggle="lightbox"
                        data-gallery="example-gallery">
                        <img src="https://new.jayga.io/uploads/{{ $item->listing_targetlocation }}" id="product-img">
                    </a>
                @endforeach
            </div>



        </div>

        <!--description-->

        <div class="row justify-content-between">
            <div class="col-md-8 ">
                <h2 class="card-title mb-3">Description</h2>
                <p><img src="{{ asset('assets/img/user.svg') }}" alt=""> {{ $listing[0]->guest_num }} Guests
                    <span> &#8901; <img src="{{ asset('assets/img/beds.svg') }}"
                            alt="">{{ $listing[0]->bed_num }} bedrooms</span>
                    <span> &#8901; <img src="{{ asset('assets/img/bath.svg') }}"
                            alt="">{{ $listing[0]->bathroom_num }} baths</span>
                </p>
                <hr>
                <div class="card-body mt-5">
                    @if ($listing[0]->description)
                        {{ $listing[0]->description }}
                    @else
                        <p>No description found</p>
                    @endif

                </div>
                <hr>
                <div class="card-body mt-5 d-flex justify-content-between">
                    <h2 class="card-title mb-5">
                        What this place offers
                    </h2>
                    <!-- <a href="#">Show All</a> -->
                </div>
                <!--Amenities-->
                <div class="card-body mb-3">
                    <div class="row row-cols-2 mb-5">
                        @if (count($amenities) > 0)
                            @foreach ($amenities as $item)
                                <div class="col-md-4 col-lg-4 col-sm-12">
                                    <button class="btn btn-outline-dark btn-sm m-1 px-3"
                                        style="border-radius: 22px; hover:none;" disabled><img
                                            src="{{ asset('assets/img/' . $item . '.svg') }}" class="p-1"
                                            style="color:rgb(7, 7, 7)" alt=""
                                            srcset="">{{ Str::upper($item) }}</button>
                                </div>
                            @endforeach
                        @else
                            <div class="col-6">
                                <p>No amenities found !</p>
                            </div>
                        @endif



                    </div>
                </div>
                <hr>
                <!--Jayga Protect-->
                <div class="card-body py-3 mb-2">
                    <div class="mt-3">
                        <span style="color: #139175; font-size: 32px; font-weight: 700; word-wrap: break-word">Jayga
                        </span>
                        <span
                            style="color: black; font-size: 28.85px; font-family: Montserrat; font-weight: 500; word-wrap: break-word">
                        </span>
                        <span style="color: black; font-size: 32px;  font-weight: 500; word-wrap: break-word">Protect
                            <span><img src="{{ asset('assets/img/verified-fill.png') }}" class="p-2"
                                    alt=""></span>
                        </span>

                    </div>
                    <div class="py-3 mb-4"
                        style="width: 100%; height: 100%; color: black; font-size: 23.08px; font-weight: 300; word-wrap: break-word">
                        Every booking includes free protection from Host cancellations, listing inaccuracies, and other
                        issues like trouble checking in.</div>
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

                            @if (count($listing[0]->reviews) > 0)
                                <div class="review">
                                    <div class="d-flex justify-content-between">
                                        <p class="card-title" style="font-size: larger; font-weight: 700;">
                                            {{ $listing[0]->reviews[0]->avg_rating }} |</p>
                                        <span><a href="#">Show all reviews</a></span>
                                    </div>

                                    <hr style="border:3px solid #f1f1f1">

                                    <div class="row">
                                        <div class="side">
                                            <div>5 star</div>
                                        </div>
                                        <div class="middle">
                                            <div class="bar-container">
                                                <div class="bar-{{ $five }}"></div>
                                            </div>
                                        </div>
                                        <div class="side right">
                                            <div>{{ $five }}</div>
                                        </div>
                                        <div class="side">
                                            <div>4 star</div>
                                        </div>
                                        <div class="middle">
                                            <div class="bar-container">
                                                <div class="bar-{{ $four }}"></div>
                                            </div>
                                        </div>
                                        <div class="side right">
                                            <div>{{ $four }}</div>
                                        </div>
                                        <div class="side">
                                            <div>3 star</div>
                                        </div>
                                        <div class="middle">
                                            <div class="bar-container">
                                                <div class="bar-{{ $three }}"></div>
                                            </div>
                                        </div>
                                        <div class="side right">
                                            <div>{{ $three }}</div>
                                        </div>
                                        <div class="side">
                                            <div>2 star</div>
                                        </div>
                                        <div class="middle">
                                            <div class="bar-container">
                                                <div class="bar-{{ $two }}"></div>
                                            </div>
                                        </div>
                                        <div class="side right">
                                            <div>{{ $two }}</div>
                                        </div>
                                        <div class="side">
                                            <div>1 star</div>
                                        </div>
                                        <div class="middle">
                                            <div class="bar-container">
                                                <div class="bar-{{ $one }}"></div>
                                            </div>
                                        </div>
                                        <div class="side right">
                                            <div>{{ $one }}</div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="review">
                                    No Reviews Yet
                                </div>
                            @endif

                            <!--Highlighted reviews -->
                            <!--
                                
                                
                                -->


                            @if (isset($user[0]))

                                <div class="mt-5">
                                    <h5>Highlighted Reviews</h5>
                                </div>
                                <div class="card mt-3" style="width: 100%; background-color: #e3e2e2;">
                                    <div class="card-body">

                                        <div class="row justify-content-between">
                                            <div class="col-8 d-flex">

                                                @if (isset($user[0]->user_avatar))
                                                    <img src="{{ asset('/uploads/' . $user[0]->user_avatar->user_targetlocation) }}"
                                                        class="rounded-circle" style="width: 50px; height: 50px;"
                                                        alt="">
                                                @else
                                                    <img src="{{ asset('assets/img/user_with_no_profile_picture.png') }}"
                                                        class="rounded-circle" style="width: 50px; height: 50px;"
                                                        alt="" srcset="">
                                                @endif


                                                <div class="mx-2">
                                                    <h5 style="line-height: 0.5;">{{ $user[0]->user->name }}</h5>
                                                    <span class="fs-6 py-0"
                                                        style="color: #158E72; font-weight: 600">Verified User</span>
                                                    <p class="my-2">{{ $user[0]->description }}</p>
                                                </div>



                                            </div>
                                            <div class="col-4">
                                                <div>{{ $user[0]->created_at->diffForHumans() }}</div>
                                                <div>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star"></span>
                                                </div>

                                            </div>
                                        </div>


                                    </div>
                                </div>
                            @else
                                <div>

                                </div>
                            @endif


                            <!-- end -->

                        </div>
                    </div>
                </div>

                <hr>

            </div>
            <!-- Booking Form -->
            <div class="col-md-4 ">
                <div class="card px-2" style="width: 100%; height: auto; border-radius: 25px;">
                    <form action="{{ route('clientbooking') }}" method="POST">
                        @csrf
                        <div class="container">
                            <input type="hidden" name="user_id" value="{{ Session::get('user') }}">
                            <input type="hidden" name="booking_order_name" value="{{ Session::get('user_name') }}">
                            <input type="hidden" name="phone" value="{{ Session::get('phone') }}">
                            <input type="hidden" name="email" value="{{ Session::get('user_email') }}">
                            <input type="hidden" name="listing_id" value="{{ $listing[0]->listing_id }}">
                            <input type="hidden" name="lister_id" value="{{ $listing[0]->lister_id }}">
                            <div class="d-flex justify-content-between  my-5">
                                <h2 class="card-title ">
                                    <input type="hidden" id="input_price" name="net_payable"
                                        value="{{ $listing[0]->full_day_price_set_by_user }}">
                                    <span id="price">{{ $listing[0]->full_day_price_set_by_user }}</span>
                                    ৳ <span id="updatePrice"></span>
                                    <span class="fs-6" id="slot">/ Per night</span>
                                </h2>
                                <div>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                    <div>
                                        {{ count($listing[0]->reviews) }} Reviews
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="card" style="box-sizing: border-box;">
                                        <!--Short stay slot-->
                                        @if ($listing[0]->allow_short_stay)
                                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#flush-collapseOne" aria-expanded="false"
                                                            aria-controls="flush-collapseOne" id="short_stay_button">
                                                            <input type="hidden" value="0" name="short_stay">
                                                            <input type="checkbox" value="1" name="short_stay"
                                                                id="short_stay_check">
                                                            <span class="mx-2">Short Stay</span>
                                                        </button>
                                                    </h2>
                                                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                                                        data-bs-parent="#accordionFlushExample">
                                                        <div class="accordion-body">
                                                            <div class="row ">
                                                                <div class="col-12 col-sm-12 justify-content-between">


                                                                    <div class="d-flex justify-content-between">
                                                                        <div>

                                                                            <input type="checkbox"
                                                                                value="{{ $slots[0]->time_id }}"
                                                                                name="short_stay_slot" id="s1">
                                                                            <span class="px-2">Slot 1</span>
                                                                        </div>


                                                                        <span>{{ $slots[0]->times }}</span>


                                                                    </div>

                                                                </div>
                                                                <div class="d-flex justify-content-between">
                                                                    <div>

                                                                        <input type="checkbox"
                                                                            value="{{ $slots[1]->time_id }}"
                                                                            name="short_stay_slot" id="s2">
                                                                        <span class="px-2">Slot 2</span>
                                                                    </div>


                                                                    <span>{{ $slots[1]->times }}</span>
                                                                </div>
                                                                <div class="d-flex justify-content-between">
                                                                    <div>

                                                                        <input type="checkbox"
                                                                            value="{{ $slots[2]->time_id }}"
                                                                            name="short_stay_slot" id="s3">
                                                                        <span class="px-2">Slot 3</span>
                                                                    </div>


                                                                    <span>{{ $slots[2]->times }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        @else
                                            <div class="card-text text-center">
                                                Short stay not available for this listing
                                            </div>
                                        @endif

                                    </div>

                                    <div class="col-12">

                                        <div class="form-floating mt-5 mb-3">
                                            <input type="text" name="daterange" class="form-control"
                                                id="daterangeinput" required />
                                            <label for="floatingInput">Checkin - Checkout</label>



                                        </div>








                                    </div>

                                    <div class="col-12">
                                        <div class="my-3 mx-2">
                                            <p class="text-dark">Guests : <input type="number" name="guest_num"
                                                    id="guest" style="border: 0;" value="1"></p>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="card-text">Adult</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-group py-2">

                                                        <input type="button" value="-"
                                                            class="button-minus border rounded-circle  icon-shape icon-sm mx-1 "
                                                            data-field="quantity">
                                                        <input type="number" step="1" max="10"
                                                            value="1" name="quantity"
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
                                                        <input type="number" step="1" max="10"
                                                            value="0" name="quantity"
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
                                                        <input type="number" step="1" max="10"
                                                            value="0" name="quantity"
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
                                    <div class="container d-flex justify-content-between mb-5">

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
                                        <input type="hidden" id="total_money" name="total_paid"
                                            value="{{ $listing[0]->full_day_price_set_by_user + ($listing[0]->full_day_price_set_by_user * 3) / 100 }}">
                                        <span style="font-size: 32px; font-weight: 700;" id="pay_amount">৳
                                            {{ $listing[0]->full_day_price_set_by_user + ($listing[0]->full_day_price_set_by_user * 3) / 100 }}</span>
                                    </div>
                                    <div class="my-3">
                                        <button type="submit" class="form-control btn btn-success p-3"
                                            style="border-radius: 25px;">Book
                                            Now</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>



                </div>
            </div>


        </div>



        <!--location-->

        <div class="row my-5">

            <div class="col-12">

                @if (isset($listing[0]->lat) && isset($listing[0]->long))
                    <h2>Location</h2>
                    <div id="map" style="width:100%;height:400px;"></div>
                @else
                    <div>Location not found</div>
                @endif


            </div>

        </div>

        <!--Need to be done-->

        <!--Host details-->
        <div class="row my-5">
            <div class="d-flex justify-content-between mb-5">
                <div class="col-md-6 col-sm-12 d-flex">
                    @if ($listing[0]->host->avatars)
                        <img src="https://new.jayga.io/uploads/{{ $listing[0]->host->avatars->user_targetlocation }}"
                            class="rounded-circle" style="width: 120px; height: 120px;" alt="">
                    @else
                        <img src="{{ asset('assets/img/user_with_no_profile_picture.png') }}" class="rounded-circle"
                            style="width: 120px; height: 120px;" alt="" srcset="">
                    @endif

                    <div class="container mx-5">
                        <div
                            style="width: 100%;  color: #838383; font-size: 18px;  font-weight: 300;  word-wrap: break-word">
                            Hosted by</div>
                        <div class="card-title" style="font-size: 32px; font-weight: 500;">
                            {{ $listing[0]->host->name }}
                        </div>
                        <div class="py-3">
                            <i class="fa fa-star checked"></i>
                            <span>{{ count($listing[0]->reviews) }} Host Reviews</span>
                        </div>
                        <div>
                            <i class="fa fa-user" style="color: #09CA9C;"></i>
                            <span class="px-2">Identity Verified</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" id="host_desc">
                    @if ($listing[0]->host->about)
                        <div class="card-text">
                            {{ $listing[0]->host->about }}
                        </div>
                    @else
                        <div class="card-text">
                            <small class="text-muted fs-6 fw-lighter fst-italic">Host description not provided!</small>
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
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <span style="font-size: 20px; font-weight: 500">Host Restrictions</span>
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row row-cols-2 mb-3">
                                @if (count($restrictions) > 0)
                                    @foreach ($restrictions as $item)
                                        <div class="col-md-4 col-lg-4 col-sm-12">
                                            <button class="btn btn-outline-dark btn-sm m-1 px-3"
                                                style="border-radius: 22px; hover:none;" disabled><img
                                                    src="{{ asset('assets/img/' . $item . '.svg') }}" class="p-1"
                                                    style="color:rgb(7, 7, 7)" alt="" srcset="">
                                                {{ Str::upper($item) }}</button>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-6">
                                        <p>No restrictions found !</p>
                                    </div>
                                @endif



                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item my-3">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <span style="font-size: 20px; font-weight: 500">Availability Check</span>
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            Coming Soon...
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <span style="font-size: 20px; font-weight: 500">Cancelation Policies</span>
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                        data-bs-parent="#accordionExample">
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
                    <span class="px-2 text-muted">Report this posting</span>
                </div>
            </div>
        </div>

        <hr>



    </div>
    <!--Footer-->
    @include('footer')

    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-arrow-up"
            aria-hidden="true"></i></button>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

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

    <!--short stay calculation -->
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



        short_stay.addEventListener('click', function() {

            short_stay_select.toggleAttribute('checked');
        });

        var whole_day_price = parseInt(price.textContent);

        // var priceUpdate = document.getElementById('updatePrice');
        // priceUpdate.style.display = 'none';

        s1.addEventListener('change', function() {

            var listing_price = <?php echo $listing[0]->full_day_price_set_by_user; ?>;


            s1.toggleAttribute('checked');
            s2.toggleAttribute('disabled');
            s3.toggleAttribute('disabled');


            if (s1.hasAttribute('checked')) {
                var calc_price = ((whole_day_price * 40) / 100);
                var new_price = whole_day_price + calc_price;
                var update_price = new_price * (1 / 4);
                // priceUpdate.innerText = update_price;
                var commision = (whole_day_price * 3) / 100;
                perday.innerText = 'per slot';
                price.innerHTML = update_price;
                // priceUpdate.style.display = 'block';
                slot_no.innerText = '1';
                slot_stay_price = update_price + commision;
                total_money.setAttribute('value', slot_stay_price);
                pay.innerHTML = '৳' + slot_stay_price;

                $('input[name="daterange"]').daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                });

            } else {
                var commision = (whole_day_price * 3) / 100;
                perday.innerText = 'per day';
                price.innerHTML = listing_price;
                //  priceUpdate.style.display = 'none';
                slot_no.innerText = '0';
                slot_stay_price = whole_day_price + commision;
                total_money.setAttribute('value', slot_stay_price);
                pay.innerHTML = '৳' + slot_stay_price;

                $('input[name="daterange"]').daterangepicker({
                    opens: 'left',

                    // isInvalidDate: function(ele) {

                    //    var currDate = moment(ele._d).format('YY-MM-DD');

                    //    return ["24-02-05", "24-02-09"].indexOf(currDate) != -1;
                    // },

                    startDate: new Date(),
                    locale: {
                        cancelLabel: 'Clear'
                    }

                }, function(start, end, label) {


                    // console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') );
                    // date1 = start.format('YYYY-MM-DD');
                    //  date2 = end.format('YYYY-MM-DD');



                    let checkin = new Date(start).getTime();
                    let checkout = new Date(end).getTime();

                    // console.log(checkin);
                    let Difference_In_Time =
                        checkout - checkin;

                    // Calculating the no. of days between
                    // two dates
                    let Difference_In_Days = Math.round(Difference_In_Time / (1000 * 3600 * 24)) - 1;

                    var new_payAmount = parseInt(price);
                    var updated_price = new_payAmount * Difference_In_Days;
                    var fee = (updated_price * 3) / 100;
                    var total = updated_price + fee;


                    total_money.setAttribute('value', total);
                    input_price.setAttribute('value', updated_price);
                    pay.innerHTML = '৳' + total;

                    slot_name.innerHTML = 'Nights';
                    slot_no.innerHTML = Difference_In_Days;






                });

                $('input[name="daterange"]').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');
                });

            }








        });

        s2.addEventListener('click', function() {
            var listing_price = <?php echo $listing[0]->full_day_price_set_by_user; ?>;


            s1.toggleAttribute('disabled');
            s2.toggleAttribute('checked');
            s3.toggleAttribute('disabled');
            if (s2.hasAttribute('checked')) {
                var calc_price = ((whole_day_price * 40) / 100);
                var new_price = whole_day_price + calc_price;
                var update_price = new_price * (1 / 4);
                // priceUpdate.innerText = update_price;
                var commision = (whole_day_price * 3) / 100;
                perday.innerText = 'per slot';
                price.innerHTML = update_price;
                // priceUpdate.style.display = 'block';
                slot_no.innerText = '2';
                slot_stay_price = update_price + commision;
                total_money.setAttribute('value', slot_stay_price);
                pay.innerHTML = '৳' + slot_stay_price;

                $('input[name="daterange"]').daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                });

            } else {
                var commision = (whole_day_price * 3) / 100;
                perday.innerText = 'per day';
                price.innerHTML = listing_price;
                // priceUpdate.style.display = 'none';
                slot_no.innerText = '0';
                slot_stay_price = whole_day_price + commision;
                total_money.setAttribute('value', slot_stay_price);
                pay.innerHTML = '৳' + slot_stay_price;
                $('input[name="daterange"]').daterangepicker({
                    opens: 'left',

                    // isInvalidDate: function(ele) {

                    //    var currDate = moment(ele._d).format('YY-MM-DD');

                    //    return ["24-02-05", "24-02-09"].indexOf(currDate) != -1;
                    // },

                    startDate: new Date(),
                    locale: {
                        cancelLabel: 'Clear'
                    }

                }, function(start, end, label) {


                    // console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') );
                    // date1 = start.format('YYYY-MM-DD');
                    //  date2 = end.format('YYYY-MM-DD');



                    let checkin = new Date(start).getTime();
                    let checkout = new Date(end).getTime();

                    // console.log(checkin);
                    let Difference_In_Time =
                        checkout - checkin;

                    // Calculating the no. of days between
                    // two dates
                    let Difference_In_Days = Math.round(Difference_In_Time / (1000 * 3600 * 24)) - 1;

                    var new_payAmount = parseInt(price);
                    var updated_price = new_payAmount * Difference_In_Days;
                    var fee = (updated_price * 3) / 100;
                    var total = updated_price + fee;


                    total_money.setAttribute('value', total);
                    input_price.setAttribute('value', updated_price);
                    pay.innerHTML = '৳' + total;

                    slot_name.innerHTML = 'Nights';
                    slot_no.innerHTML = Difference_In_Days;






                });

                $('input[name="daterange"]').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');
                });

            }
        });

        s3.addEventListener('click', function() {
            var listing_price = <?php echo $listing[0]->full_day_price_set_by_user; ?>;

            s1.toggleAttribute('disabled');
            s2.toggleAttribute('disabled');
            s3.toggleAttribute('checked');

            if (s3.hasAttribute('checked')) {
                var calc_price = ((whole_day_price * 40) / 100);
                var new_price = whole_day_price + calc_price;
                var update_price = new_price * (2 / 4);
                // priceUpdate.innerText = update_price;
                var commision = (whole_day_price * 3) / 100;
                perday.innerText = 'per slot';
                price.innerHTML = update_price;
                // priceUpdate.style.display = 'block';
                slot_no.innerText = '3';
                slot_stay_price = update_price + commision;
                total_money.setAttribute('value', slot_stay_price);
                pay.innerHTML = '৳' + slot_stay_price;

                $('input[name="daterange"]').daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                });

            } else {
                var commision = (whole_day_price * 3) / 100;
                perday.innerText = 'per day';
                price.innerHTML = listing_price;
                // priceUpdate.style.display = 'none';
                slot_no.innerText = '0';
                slot_stay_price = whole_day_price + commision;
                total_money.setAttribute('value', slot_stay_price);
                pay.innerHTML = '৳' + slot_stay_price;

                $('input[name="daterange"]').daterangepicker({
                    opens: 'left',

                    // isInvalidDate: function(ele) {

                    //    var currDate = moment(ele._d).format('YY-MM-DD');

                    //    return ["24-02-05", "24-02-09"].indexOf(currDate) != -1;
                    // },

                    startDate: new Date(),
                    locale: {
                        cancelLabel: 'Clear'
                    }

                }, function(start, end, label) {


                    // console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') );
                    // date1 = start.format('YYYY-MM-DD');
                    //  date2 = end.format('YYYY-MM-DD');



                    let checkin = new Date(start).getTime();
                    let checkout = new Date(end).getTime();

                    // console.log(checkin);
                    let Difference_In_Time =
                        checkout - checkin;

                    // Calculating the no. of days between
                    // two dates
                    let Difference_In_Days = Math.round(Difference_In_Time / (1000 * 3600 * 24)) - 1;

                    var new_payAmount = parseInt(price);
                    var updated_price = new_payAmount * Difference_In_Days;
                    var fee = (updated_price * 3) / 100;
                    var total = updated_price + fee;


                    total_money.setAttribute('value', total);
                    input_price.setAttribute('value', updated_price);
                    pay.innerHTML = '৳' + total;

                    slot_name.innerHTML = 'Nights';
                    slot_no.innerHTML = Difference_In_Days;






                });

                $('input[name="daterange"]').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');
                });


            }
        });
    </script>


    <script>
        var qty = 1;
        var guest_numbr = document.getElementById('guest');

        function incrementValue(e) {
            e.preventDefault();

            var fieldName = $(e.target).data('field');
            var parent = $(e.target).closest('div');
            var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

            if (!isNaN(currentVal)) {
                parent.find('input[name=' + fieldName + ']').val(currentVal + 1);


            } else {
                parent.find('input[name=' + fieldName + ']').val(0);
                qty = 0;
            }
            qty++;
            guest_numbr.value = qty;
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
            qty--;
            guest_numbr.value = qty;
        }

        $('.input-group').on('click', '.button-plus', function(e) {
            incrementValue(e);
        });

        $('.input-group').on('click', '.button-minus', function(e) {
            decrementValue(e);
        });
    </script>

    <!--date range picker -->
    <script>
        $(function() {

            //  var date1 = document.getElementById('floatingInput1');
            //  var date2 = document.getElementById('floatingInput2');
            var price = document.getElementById('price').textContent;
            var slot_name = document.getElementById('slot_name');
            var slot_no = document.getElementById('slot_no');
            var input_price = document.getElementById('input_price');

            // var dates = @json($disable_dates);
            // var disabled_dates = [];
            //   dates.forEach(element => {
            //      disabled_dates.push(element.dates);
            //  });



            $('input[name="daterange"]').daterangepicker({
                opens: 'left',

                // isInvalidDate: function(ele) {

                //    var currDate = moment(ele._d).format('YY-MM-DD');

                //    return ["24-02-05", "24-02-09"].indexOf(currDate) != -1;
                // },

                startDate: new Date(),
                locale: {
                    cancelLabel: 'Clear'
                }

            }, function(start, end, label) {


                // console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') );
                // date1 = start.format('YYYY-MM-DD');
                //  date2 = end.format('YYYY-MM-DD');



                let checkin = new Date(start).getTime();
                let checkout = new Date(end).getTime();

                // console.log(checkin);
                let Difference_In_Time =
                    checkout - checkin;

                // Calculating the no. of days between
                // two dates
                let Difference_In_Days = Math.round(Difference_In_Time / (1000 * 3600 * 24)) - 1;

                var new_payAmount = parseInt(price);
                var updated_price = new_payAmount * Difference_In_Days;
                var fee = (updated_price * 3) / 100;
                var total = updated_price + fee;


                total_money.setAttribute('value', total);
                input_price.setAttribute('value', updated_price);
                pay.innerHTML = '৳' + total;

                slot_name.innerHTML = 'Nights';
                slot_no.innerHTML = Difference_In_Days;






            });

            $('input[name="daterange"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });
        });
    </script>


    <!--go to top btn -->

    <script>
        // Get the button:
        let mybutton = document.getElementById("myBtn");

        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            document.body.scrollTop = 0; // For Safari
            document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
        }
    </script>

    <!-- google map -->
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script>
        /**
         * @license
         * Copyright 2019 Google LLC. All Rights Reserved.
         * SPDX-License-Identifier: Apache-2.0
         */
        // This example requires the Places library. Include the libraries=places
        // parameter when you first load the API. For example:
        // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
        function initMap() {
            const map = new google.maps.Map(document.getElementById("map"), {
                center: {
                    lat: <?php echo $listing[0]->lat; ?>,
                    lng: <?php echo $listing[0]->long; ?>
                },
                zoom: 15,
            });
            const request = {
                placeId: "ChIJN1t_tDeuEmsRUsoyG83frY4",
                fields: ["name", "formatted_address", "place_id", "geometry"],
            };
            const infowindow = new google.maps.InfoWindow();
            const service = new google.maps.places.PlacesService(map);

            service.getDetails(request, (place, status) => {
                if (
                    status === google.maps.places.PlacesServiceStatus.OK
                ) {
                    const marker = new google.maps.Marker({
                        map,
                        position: {
                            lat: <?php echo $listing[0]->lat; ?>,
                            lng: <?php echo $listing[0]->long; ?>
                        },
                    });

                    google.maps.event.addListener(marker, "click", () => {
                        const content = document.createElement("div");
                        const nameElement = document.createElement("h2");

                        nameElement.textContent = <?php echo json_encode($listing[0]->listing_title); ?>;
                        content.appendChild(nameElement);

                        // const placeIdElement = document.createElement("p");

                        // placeIdElement.textContent = place.place_id;
                        //  content.appendChild(placeIdElement);

                        const placeAddressElement = document.createElement("p");

                        placeAddressElement.textContent = <?php echo json_encode($listing[0]->listing_address); ?>;
                        content.appendChild(placeAddressElement);

                        const imageElement = document.createElement("img");
                        imageElement.src = "https://new.jayga.io/uploads/" + <?php echo json_encode($listing[0]->images[0]->listing_targetlocation); ?>;
                        content.appendChild(imageElement);

                        infowindow.setContent(content);
                        infowindow.open(map, marker);
                    });
                }
            });
        }

        window.initMap = initMap;
    </script>

    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAG8IAuH-Yz4b3baxmK1iw81BH5vE4HsSs&callback=initMap&libraries=places&v=weekly&solution_channel=GMP_CCS_placedetails_v1">
    </script>

</body>

</html>
