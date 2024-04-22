<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <title>Jayga | Search Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Epilogue">
    <style>

        body::-webkit-scrollbar {
            display: none;
        }

        body {
            max-width: 100%;
            font-family: "Epilogue";
            overflow-x: hidden;
        }

        .checked {
            color: orange;
        }

        .nav-link {
            color: #158E72;
            font-weight: 700;
        }

        #card-image-view {

            width: 100%;
            aspect-ratio: 4/3;
            object-fit: contain;
           border-radius: 30px;
        }

        .card {
            border: 0;
        }

        .box {
            box-sizing: border-box;
            background-color: white;
            padding: 5px;
            margin: 30px;
            border-radius: 20px;
            align-items: center;
        }

        .text {
            padding: 5px;
            font-size: medium;
            font-weight: 700;
            text-align: center;

        }

        #hide {
            display: none;
        }


        @media (max-width: 600px) {

            #hide {
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
            display: none; /* Hidden by default */
            position: fixed; /* Fixed/sticky position */
            bottom: 20px; /* Place the button at the bottom of the page */
            right: 30px; /* Place the button 30px from the right */
            z-index: 99; /* Make sure it does not overlap */
            border: none; /* Remove borders */
            outline: none; /* Remove outline */
            background-color: #158E72; /* Set a background color */
            color: white; /* Text color */
            cursor: pointer; /* Add a mouse pointer on hover */
            padding: 15px; /* Some padding */
            border-radius: 10px; /* Rounded corners */
            font-size: 18px; /* Increase font size */
        }

        #myBtn:hover {
            background-color: #555; /* Add a dark-grey background on hover */
        }
        
    </style>
</head>

<body>


    <div style="background-image: url({{ asset('assets/img/bg.png') }}); background-size:contain">
        <!--Navbar Section-->
        @include('navbar')
        <form action="{{ route('searchroute') }}" method="POST" enctype="application/x-www-form-urlencoded">

            @csrf
            <!--Search Section-->
            <div class="container mb-5">

                <!--title-->
                <div class="mt-5 text-center" id="hide">
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

                <div class="row py-2 mt-5">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div style="width: 100%;   left: 0px;  background: white; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.25); border-radius: 30px; overflow: hidden;"
                            class="mb-5">
                            <div class="container">
                                <div class="row p-4">


                                    <div class="col-md-2 col-lg-2 col-sm-12 p-2">
                                        <div class="form-floating">
                                            <select class="form-control" name="category" id="category-form" aria-placeholder="Town or City"
                                                aria-label="Large select example" required>
                                                <option value="">Select Category</option>
                                                <option value="room">Rooms</option>
                                                <option value="hotel">Hotels</option>
                                                <option value="apartment">Apartment</option>

                                            </select>
                                            <label for="formfloating">Select Category</label>
                                        </div>
                                    </div>

                                    <div class="col-md-2 col-lg-2 col-sm-12 p-2">
                                        <!--search inputs-->
                                        <div class="form-floating">
                                            <select class="form-control" name="city" id="city" aria-placeholder="Town or City"
                                                aria-label="Large select example" required>
                                                <option value="">Select a city or town</option>
                                                <option value="Dhaka">Dhaka</option>
                                                <option value="Sylhet">Sylhet</option>
                                                <option value="Chittagong">Chittagong</option>
                                            </select>
                                            <label for="formfloating">Select city or town</label>
                                        </div>
                                    </div>

                                    <div class="col-md-2 col-lg-2 col-sm-12 p-2">
                                        <div class="form-floating w-100">
                                            <input type="text" name="daterange" id="daterange" class="form-control" value=""
                                                required />
                                            <label for="floatingInput">Checkin - Checkout</label>

                                           


                                        </div>
                                    </div>





                                    <div class="col-md-2 col-lg-2 col-sm-12 p-2">
                                        <div class="form-floating">
                                            <input type="number" name="guests" id="guests" class="form-control"
                                                placeholder="Guests">
                                            <label class="form-label">Guests</label>

                                        </div>
                                    </div>

                                    <div class="col-md-2 col-sm-12 col-lg-2 text-center py-2">

                                        <button type="submit"
                                            class="btn btn-success form-control btn-lg">Search</button>



                                    </div>

                                </div>

                            </div>

                        </div>


                    </div>
                </div>


            </div>
        </form>
    </div>


    <!--Listing section-->
    <div class="container ">
        <div class="card-title d-flex justify-content-between mb-3">
            
            @if (isset($latest))
                <h3 class="mt-5">Showing Latest Listings</h3>
            @elseif(isset($top))
                <h3 class="mt-5">Showing Top {{$listings->count() }} listings of all time</span></h3>
                
            @else
                 <h3 class="mt-5">{{ $listings->count() }} Properties Found</h3>

            @endif

          <!--  <a href="#" class="mt-5" style="color: #158E72; font-weight: 700;">View all</a> -->
        </div>
        <div class="card-header d-flex justify-content-between mb-3">
            <div class="dropdown">
                @if (isset($latest))
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Latest
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{ route('popularlistings') }}">Popularity</a></li>

                    </ul>
                @else
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Popularity
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{ route('latestlistings') }}">Latest</a></li>

                    </ul>
                @endif

            </div>
            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">Filters</button>
        </div>
        <div class="row mt-5 mb-5">
            @foreach ($listings as $item)
                <div class="col-md-3">


                    <a class="card mb-3" style="height: 100%" href="/client/single-listing/{{ $item->listing_id }}">
                        <img src="https://new.jayga.io/uploads/{{ $item->images[0]->listing_targetlocation }}"
                            id="card-image-view" alt="#">
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
                            <p class="card-text" style="font-size: 16px; line-height: 0.5">{{ $item->bed_num }} bedrooms</p>

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
        {{ $listings->links() }}
    </div>

    


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered ">
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
                                <input type="number" name="min_price" class="p-2 my-2" value="20" required>
                                <span class="p-2 mx-2">to</span>
                                <input type="number" name="max_price" class="p-2 my-2" value="20000" required>
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
                                    <input type="hidden" name="allow_short_stay" value="0">
                                    <input type="checkbox" name="allow_short_stay" value="1">
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
