<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <title>Jayga | Home</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Epilogue">
    <style>
        body::-webkit-scrollbar {
            display: none;
        }

        .checked {
            color: orange;
        }

        .nav-link {
            color: #158E72;
            font-weight: 700;
        }

        body {
            max-width: 100%;
            font-family: "Epilogue";
            overflow-x: hidden;

        }

        #card-image-view {

            width: 100%;
            height: 100%;

            object-fit: contain;
            border-radius: 27px;
        }

        .card {
            border: 0;
        }

        .box {
            box-sizing: border-box;
            background-color: white;

            margin: 30px;
            border-radius: 20px;
            align-items: center;

        }

        .text {

            font-size: medium;
            font-weight: 700;


        }

        #input {
            padding: 5px;
        }

        #mobile {
            display: none;
        }

        @media (max-width: 600px) {


            #desk {
                display: none;
            }

            #input {
                display: none;
            }

            #mobile {
                display: block;
            }

        }

        a {
            text-decoration: none;
        }

        .card:hover {
            opacity: 1;
            transition: 0.5s;
            transform: scale(1.05);

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

        .accordion-item{
            width: 100%;
        }
    </style>
</head>

<body>


    <div 
        style="background-image: url({{ asset('assets/img/bg.png') }}); width:100%; background-size: cover; object-fit:contain; ">
        <!--Navbar Section-->
        @include('navbar')

        <form action="{{ route('searchroute') }}" method="POST" enctype="application/x-www-form-urlencoded">
            @csrf
            <!--Search Section-->
            <div class="container">
                <!--title-->
                <div class="my-5 text-center py-3">
                    <span
                        style="color: black; font-size: 50px; font-family: Epilogue; font-weight: 800; word-wrap: break-word">Find
                        your next </span>
                    <span
                        style="color: #158E72; font-size: 50px; font-family: Epilogue; font-weight: 800; word-wrap: break-word">place</span>
                    <span
                        style="color: black; font-size: 50px; font-family: Epilogue; font-weight: 800; word-wrap: break-word">
                        to
                        stay</span>
                </div>

                <!--Search topbar-->

                <div style="height: auto; width: 80%; margin: auto;  background: white; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.25); border-radius: 30px; opacity: 0.8; background-blend-mode: overlay, normal; backdrop-filter: blur(40px); background: lightgray 0% 0% / 154.22531366348267px 154.22531366348267px repeat, radial-gradient(151.92% 127.02% at 15.32% 21.04%, rgba(165, 239, 255, 0.05) 0%, rgba(110, 191, 244, 0.01) 77.08%, rgba(70, 144, 212, 0.00) 100%);"
                    id="input">
                    <!--Options select-->
                    <div class="container text-center" id="desk">
                        <div class="row input-group justify-content-center my-2">
                            <div class="col-md-2 col-lg-2 col-sm-6 p-2">

                                <input type="radio" class="btn-check" name="options-base" value="room"
                                    id="option5" autocomplete="off" checked>
                                <label class="btn" for="option5"><img class="form-label"
                                        src="{{ asset('assets/img/meeting_room_24px.png') }}" alt="">
                                    Rooms</label>
                            </div>
                            <div class="col-md-2 col-lg-2 col-sm-6 p-2">
                                <input type="radio" class="btn-check" name="options-base" value="hotel"
                                    id="option6" autocomplete="off">
                                <label class="btn" for="option6"><img class="form-label"
                                        src="{{ asset('assets/img/home_24px.png') }}" alt=""> Hotels</label>
                            </div>
                            <div class="col-md-2 col-lg-2 col-sm-6 p-2">
                                <input type="radio" class="btn-check" name="options-base" value="apartment"
                                    id="option7" autocomplete="off">
                                <label class="btn" for="option7"><img class="form-label"
                                        src="{{ asset('assets/img/business_24px.png') }}" alt="">
                                    Apartments</label>
                            </div>

                            <!--
                                 
                                
                                -->
                            <div class="col-md-2 col-lg-2 col-sm-6 p-2">
                                <input type="radio" class="btn-check" name="options-base" value="parking"
                                    id="option8" autocomplete="off">

                                <label class="btn" for="option8"><img class="form-label"
                                        src="{{ asset('assets/img/parking icon.png') }}" alt=""> Parking
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-secondary">
                                        <small>Coming soon</small>
                                        <span class="visually-hidden"></span>
                                    </span>
                                </label>

                            </div>

                            <div class="col-md-2 col-lg-2 col-sm-6 p-2">
                                <input type="radio" class="btn-check" name="options-base" value="experience"
                                    id="option9" autocomplete="off">
                                <label class="btn" for="option9"><img class="form-label"
                                        src="{{ asset('assets/img/map_24px.png') }}" alt=""> Experience
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-secondary">
                                        <small>Coming soon</small>
                                        <span class="visually-hidden"></span>
                                    </span>
                                </label>
                            </div>
                            <div class="col-md-2 col-lg-2 col-sm-6 p-2">
                                <input type="radio" class="btn-check" name="options-base" value="storage"
                                    id="option10" autocomplete="off">
                                <label class="btn" for="option10"><img class="form-label"
                                        src="{{ asset('assets/img/Cube  24  Outline.png') }}" alt=""> Storage
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-secondary">
                                        <small>Coming soon</small>
                                        <span class="visually-hidden"></span>
                                    </span>
                                </label>
                            </div>
                        </div>











                    </div>
                </div>



                <div class="row mb-5">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div
                            style="width: 80%;  margin: auto;  background: white; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.25); border-radius: 30px;  background-blend-mode: overlay, normal;  background: lightgray 0% 0% / 154.22531366348267px 154.22531366348267px repeat, radial-gradient(151.92% 127.02% at 15.32% 21.04%, rgba(165, 239, 255, 0.05) 0%, rgba(110, 191, 244, 0.01) 77.08%, rgba(70, 144, 212, 0.00) 100%);">
                            <div class="container">
                                <div class="row p-3 text-center">

                                    <div class="col-sm-12 p-2" id="mobile">
                                        <div class="form-floating">
                                            <select class="form-control" name="category"
                                                aria-placeholder="Town or City" aria-label="Large select example">
                                                <option value="default">Select Category</option>
                                                <option value="room">Rooms</option>
                                                <option value="hotel">Hotels</option>
                                                <option value="apartment">Apartment</option>

                                            </select>
                                            <label for="formfloating">Select Category</label>
                                        </div>
                                    </div>


                                    <div class="col-md-3 col-lg-3 col-sm-12 p-2">
                                        <!--search inputs-->
                                        <div class="form-floating">
                                            <select class="form-control" name="city"
                                                aria-placeholder="Town or City" aria-label="Large select example" required>
                                                <option value="">Select a city or town</option>
                                                <option value="Dhaka">Dhaka</option>
                                                <option value="Sylhet">Sylhet</option>
                                                <option value="Chittagong">Chittagong</option>
                                            </select>
                                            <label for="formfloating">Select city or town</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6  col-lg-6 col-sm-12 p-2">
                                        <div class="form-floating w-100">
                                            <input type="text" name="daterange" class="form-control"
                                                value="" required />
                                            <label for="floatingInput">Checkin - Checkout</label>

                                          


                                        </div>

                                    </div>





                                    <div class="col-md-3 col-lg-3 col-sm-12 p-2">
                                        <div class="form-floating">
                                            <input type="number" name="guests" class="form-control"
                                                placeholder="Guests">
                                            <label class="form-label">Guests</label>

                                        </div>

                                    </div>


                                </div>

                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12 text-center mt-4 mb-5">
                                <button type="submit" class="btn btn-success btn-lg px-4">Search</button>
                            </div>

                        </div>

                    </div>
                </div>

            </div>



        </form>


    </div>

    <!--Listing section-->
    <div class="container " id="listings">
        <div class="card-title d-flex justify-content-between mb-3">

            <h3 class="mt-5">Top Listings</h3>


            <a href="{{route('popularlistings')}}" class="mt-5" style="color: #158E72; font-weight: 700;">View all</a>
        </div>
        <div class="card-header d-flex justify-content-between mb-3">
            <div class="dropdown">

                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Popularity
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="{{ route('latestlistings') }}">Latest</a></li>

                </ul>


            </div>
            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">Filters</button>
        </div>
        <div class="row mt-5 mb-5">
            @foreach ($listings as $item)
                <div class="col-md-3">


                    <a class="card mb-3" href="/client/single-listing/{{ $item->listing_id }}">
                        <img src="https://new.jayga.io/uploads/{{ $item->images[0]->listing_targetlocation }}"
                            class="card-img-top" id="card-image-view" alt="#">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-9">
                                    <h6 class="card-title" style="20px; font-weight: 600;">{{ $item->listing_title }}
                                    </h6>

                                </div>
                                <div class="col-3" style="text-align: right">
                                    @if (count($item->reviews) > 0)
                                        <div>
                                            <i class="fa fa-star checked mx-1"></i><span class="card-text">
                                                {{ $item->reviews[0]->avg_rating }}</span>
                                        </div>
                                    @else
                                        <div>
                                            <i class="fa fa-star checked mx-1"></i><span class="text-muted"> 0</span>
                                        </div>
                                    @endif

                                </div>
                            </div>
                            <p class="card-text" style="font-size: 16px;">{{$item->town}} &#8901; {{ $item->district }}</p>
                            <p class="card-text" style="font-size: 16px;">{{ $item->bed_num }} bedrooms</p>

                            @if ($item->allow_short_stay == true)
                                <p class="card-text">
                                    <span style="color: #158E72">Short stay</span> available


                                </p>
                            @else
                                <p class="card-text">
                                    <span style="color: #158E72">{{ $item->guest_num }} Guests</span>
                                </p>
                            @endif



                            <p class="card-text">
                                ৳ <span style="font-size: 20px; font-weight:800;">
                                    {{ $item->full_day_price_set_by_user }}</span> <span>/ Night</span>
                            </p>
                        </div>
                    </a>


                </div>
            @endforeach



        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true" >
        <div class="modal-dialog modal-lg modal-dialog-centered" >
            <div class="modal-content">
                <form action="{{route('filterroute')}}" method="GET"
                    enctype="application/x-www-form-urlencoded">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Filters</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body modal-dialog-scrollable">

                        <div class="container">
                            <div class="input-group mb-3">
                                <h5 class="input-group title mb-3">Property Type</h5>
                                <div class="my-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="listing_type"
                                            id="inlineRadio1" value="room" checked>
                                        <label class="form-check-label" for="inlineRadio1">Room</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="listing_type"
                                            id="inlineRadio2" value="hotel">
                                        <label class="form-check-label" for="inlineRadio2">Hotel</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="listing_type"
                                            id="inlineRadio3" value="apartment">
                                        <label class="form-check-label" for="inlineRadio3">Apartment</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="listing_type"
                                            id="inlineRadio4" value="parking">
                                        <label class="form-check-label" for="inlineRadio4">Parking</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="listing_type"
                                            id="inlineRadio5" value="experience">
                                        <label class="form-check-label" for="inlineRadio5">Experience</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="listing_type"
                                            id="inlineRadio6" value="storage">
                                        <label class="form-check-label" for="inlineRadio6">Storage</label>
                                    </div>
                                </div>

                            </div>
                            <div class="input-group mb-5">
                                <h5 class="input-group title">Price Range</h5>
                                <input type="number" name="min_price" class="p-2 my-2" value="20" placeholder="min" required>
                                <span class="p-2 mx-2">to</span>
                                <input type="number" name="max_price" class="p-2 my-2" value="20000" placeholder="max" required>
                            </div>
                            <div class="input-group mb-3">
                                <h5 class="input-group title mb-3">Rooms & Beds</h5>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <p class="text-dark">Bedrooms</p>
                                            </div>
                                            <div class="input-group w-auto justify-content-end align-items-center">
                                                <input type="button" value="-"
                                                    class="button-minus border rounded-circle  icon-shape icon-sm mx-1 "
                                                    data-field="bed_num">
                                                <input type="number" max="10" value="1" name="bed_num"
                                                    class="quantity-field border-0 text-center w-25">
                                                <input type="button" value="+"
                                                    class="button-plus border rounded-circle icon-shape icon-sm "
                                                    data-field="bed_num">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <p class="text-dark">Bathrooms</p>
                                            </div>
                                            <div class="input-group w-auto justify-content-end align-items-center">
                                                <input type="button" value="-"
                                                    class="button-minus border rounded-circle  icon-shape icon-sm mx-1 "
                                                    data-field="bathroom_num">
                                                <input type="number" max="10" value="1" name="bathroom_num"
                                                    class="quantity-field border-0 text-center w-25">
                                                <input type="button" value="+"
                                                    class="button-plus border rounded-circle icon-shape icon-sm "
                                                    data-field="bathroom_num">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <p class="text-dark">Guests</p>
                                            </div>
                                            <div class="input-group w-auto justify-content-end align-items-center">
                                                <input type="button" value="-"
                                                    class="button-minus border rounded-circle  icon-shape icon-sm mx-1 "
                                                    data-field="guest_num">
                                                <input type="number" max="10" value="1" name="guest_num"
                                                    class="quantity-field border-0 text-center w-25">
                                                <input type="button" value="+"
                                                    class="button-plus border rounded-circle icon-shape icon-sm "
                                                    data-field="guest_num">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <h5 class="input-group title">Short Stay Allow</h5>
                                <span>
                                   
                                    <input type="checkbox" name="allow_short_stay" value="true">
                                </span>

                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Apply Filter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!--facilities-->
    <div style="background-color: #F2F2F2; width: 100%;">
        <div class="container">
            <div class="row">
                <div class="col-8 mb-5 mx-2 p-2"
                    style="color: black; font-size: 36px; margin-top: 45px; font-weight: 600; word-wrap: break-word">
                    Facilities we provide
                </div>

                <div class="col-md-6 col-sm-6 col-lg-6">
                    <div class="box p-3 d-flex">
                        <img src="{{ asset('assets/img/360_24px.png') }}"  class="px-2" alt="">
                        <span class="text mx-1">Relocation assistance in case of unsatisfactory conditions</span>
                    </div>
                    <div class="box p-3 d-flex">
                        <img src="{{ asset('assets/img/local_atm_24px.png') }}"  alt="" class="px-2">
                        <span class="text mx-1">Reimbursements upto 50000 for security breaches and property damage
                        </span>
                    </div>
                    <div class="box p-3 d-flex">
                        <img src="{{ asset('assets/img/verified_user_24px.png') }}" alt="" class="px-2">
                        <span class="text mx-1">Safety & security helpline</span>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 mb-5">
                    <div class="box p-3 d-flex">
                        <img src="{{ asset('assets/img/security_24px.png') }}" class="px-2" alt="">
                        <span class="text mx-1">Full privacy protection</span>
                    </div>
                    <div class="box p-3 d-flex">
                        <img src="{{ asset('assets/img/ring_volume_24px.png') }}" alt="" class="px-2">
                        <span class="text mx-1">24/7 desk support</span>
                    </div>
                    <div class="box p-3 d-flex">
                        <img src="{{ asset('assets/img/local_offer_24px.png') }}" alt="" class="px-2">
                        <span class="text mx-1">Discounts and vouchers available regularly</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--faq-->
    <div style="background-color: #F2F2F2; width: 100%;">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-5 mx-2 p-2 "
                    style="color: black; font-size: 36px; margin-top: 45px; font-weight: 600; word-wrap: break-word">
                    Frequently Asked Question
                </div>

                <div class="row accordion accordion-flush d-flex" id="accordionFlushExample">
                   
                    <div class="col-md-6 col-sm-12 col-lg-6">
                        <div class="box p-3 d-flex">
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    <i class="fa fa-plus" aria-hidden="true"></i>&ensp; How do I list my property on Jayga?
                                  </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                  <div class="accordion-body">- Both our app and website include detailed guides and step by step procedure on how to list your property</div>
                                </div>
                              </div>
                            
                        </div>
                        <div class="box p-3 d-flex">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                    <i class="fa fa-plus" aria-hidden="true"></i>&ensp; What should I do if I receive a booking request on Jayga?
                                  </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                  <div class="accordion-body">- User will receive a notification on their phone app and web where you can accept the booking for the Guest’s stay.</div>
                                </div>
                              </div>
                        </div>
                        <div class="box p-3 d-flex">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                    <i class="fa fa-plus" aria-hidden="true"></i>&ensp;How does Jayga handle payments and payouts for hosts?
                                  </button>
                                </h2>
                                <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                  <div class="accordion-body">- All guests pay in advance, as soon as the stay is complete, the amount is added to the Host’s account balance from where they can request for withdrawal, every withdrawal takes 2-3 working days.</div>
                                </div>
                              </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-lg-6 mb-5">
                        <div class="box p-3 d-flex">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseOne">
                                    <i class="fa fa-plus" aria-hidden="true"></i>&ensp; How to communicate with guests on Jayga?
                                  </button>
                                </h2>
                                <div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                  <div class="accordion-body">- Hosts are advised to not get in touch with the guests unless it is an immediate emergency, all communications and queries shall be handled by Jayga support team. Sharing of numbers is strictly prohibited.</div>
                                </div>
                              </div>
                        </div>
                        <div class="box p-3 d-flex">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseTwo">
                                    <i class="fa fa-plus" aria-hidden="true"></i>&ensp; What is Jayga Protect, and how can I claim it?
                                  </button>
                                </h2>
                                <div id="flush-collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                  <div class="accordion-body">- Jayga Protect is the insurance program that Jayga offers to its hosts in case of any physical damage to their homes/belongings while a guest is at stay for a small monthly fee. Every damage must be reported within the next 12 hours or the right before the immediate booking in case consecutive reservations.</div>
                                </div>
                              </div>
                        </div>
                        <div class="box p-3 d-flex">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseThree">
                                    <i class="fa fa-plus" aria-hidden="true"></i>&ensp; How do I handle guest reviews and ratings on Jayga?
                                  </button>
                                </h2>
                                <div id="flush-collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                  <div class="accordion-body">- Maintaining cleanliness and proving all working amenities will always help in getting 5 star reviews.</div>
                                </div>
                              </div>
                        </div>
                    </div>
                    
                  </div>

               
            </div>
        </div>
    </div>

    <!--download app-->

    <div class="row align-items-center">
        <div class="col-md-6 col-sm-6 col-lg-6 text-center">
            <img src="{{ asset('assets/img/OnePlus.png') }}" style="width: 100%; height: 60%;" class=" mb-3 "
                alt="">
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6">
            <div class="p-3"
                style="width: 100%; color: #262626; font-size: 60px; font-family: Epilogue; font-weight: 500; line-height: 80px; word-wrap: break-word">
                Start exploring and reserving your favorite spots effortlessly.</div>

            <a href="https://play.google.com/store/apps/details?id=com.jayga.app&pcampaignid=web_share"
                target="_blank" class="btn">
                <img src="{{ asset('assets/img/Group.png') }}" width="240" height="70" alt="">
            </a>

        </div>
    </div>


    <!--send us messege-->
    <div style="background-color: #F2F2F2; width: 100%;">
        <div class="container">
            <div class="row align-items-center py-5">
                <div class="col-md-6 col-lg-6 col-sm-12 text-center p-5 mt-5">
                    <div
                        style="width: 100%; color: #262626; font-size: 60px; font-family: Epilogue; font-weight: 500; line-height: 80px; word-wrap: break-word">
                        Send us a message</div>
                    <div
                        style="width: 100%; color: #262626; font-size: 24px; font-family: Montserrat; font-weight: 400; line-height: 41px; word-wrap: break-word">
                        Your feedback matters! Share your thoughts with us. Your input drives our commitment to customer
                        satisfaction, shaping our user-centric approach.</div>
                </div>


                <div class="col-md-6 col-lg-6 col-sm-12 p-3 mt-3">
                    <div
                        style="width: 100%; height: 100%; position: relative; background: #ffffff; border-radius: 20px;">
                        <form class="form-control m-auto p-5" style="border-radius: 20px;">
                            <div class="mb-3" style="display: none">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.
                                </div>
                            </div>
                            <div class="mb-3" style="display: none">
                                <label for="exampleInputmessege" class="form-label">Messege</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>

                            <button type="submit" class="btn btn-success form-control"
                                style="display: none">Submit</button>
                            <div class="mb-3">
                                <img src="{{ asset('assets/img/mail.png') }}" width="40px;" height="40px;"
                                    class="mx-3" alt=""> Mail us at : info@jayga.io
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <!--Footer-->
        @include('footer')
    </div>

    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-arrow-up"
            aria-hidden="true"></i></button>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
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

        $('.button-plus').on('click', function(e) {
            incrementValue(e);
        });

        $('.button-minus').on('click', function(e) {
            decrementValue(e);
        });
    </script>

    <script>
        $(function() {

            $('input[name="daterange"]').daterangepicker({
                opens: 'left',


                locale: {
                    cancelLabel: 'Clear'
                }

            }, function(start, end, label) {


                // console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') );
               // date1.value = start.format('YYYY-MM-DD');
              //  date2.value = end.format('YYYY-MM-DD');
                return true;



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





</body>

</html>
