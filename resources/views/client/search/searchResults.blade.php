<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jayga | Search Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <style>
        .nav-link{
            color: #158E72;
        }
        #card-image-view {
            
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 27px;
        }
        .card{
            border: 0;
        }
        .box{
            box-sizing: border-box;
            background-color: white;
            padding: 5px;
            margin: 30px;
            border-radius: 20px;
            align-items: center;
        }
        .text{
            padding: 5px;
            font-size: medium;
            font-weight: 700;
            text-align: center;
            
        }

        #hide{
            display: none;
        }

      
        @media (max-width: 600px) {
        
        #hide {
            display: block;
        }

    }

    a{
        text-decoration: none;
    }
 
    .card:hover{
            opacity: 1;
            transition: 0.5s;
            transform:scale(1.05);
            
        }
    
    </style>
</head>
<body >
    

    <div style="background-color: #F2F2F2; width: 100%;">
        <!--Navbar Section-->
        @include('navbar')
        <form action="{{route('searchroute')}}" method="POST" enctype="application/x-www-form-urlencoded">
                                
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
                <span style="color: black; font-size: 50px; font-family: Epilogue; font-weight: 800; word-wrap: break-word">
                    to
                    stay</span>
            </div>

            <div class="row py-2 mt-5">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <div
                        style="width: 100%;   left: 0px;  background: white; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.25); border-radius: 30px; overflow: hidden;" class="mb-5">
                        <div class="container">
                            <div class="row p-4">

                            
                                <div class="col-md-2 col-lg-2 col-sm-12 p-2">
                                    <div class="form-floating">
                                        <select class="form-control" name="category" aria-placeholder="Town or City"
                                                aria-label="Large select example">
                                                <option selected value="default">Select Category</option>
                                                <option value="rooms">Rooms</option>
                                                <option value="hotels">Hotels</option>
                                                <option value="apartments">Apartment</option>
                                               
                                            </select>
                                        <label for="formfloating">Select Category</label>
                                    </div>
                                </div>

                                <div class="col-md-2 col-lg-2 col-sm-12 p-2">
                                    <!--search inputs-->
                                    <div class="form-floating">
                                        <select class="form-control" name="city" aria-placeholder="Town or City"
                                                aria-label="Large select example">
                                                <option selected>Select a city or town</option>
                                                <option value="Dhaka">Dhaka</option>
                                                <option value="Sylhet">Sylhet</option>
                                                <option value="Chittagong">Chittagong</option>
                                            </select>
                                        <label for="formfloating">Select city or town</label>
                                    </div>
                                </div>

                                    <div class="col-md-2 col-lg-2 col-sm-12 p-2">
                                        <div class="form-floating w-100">
                                            <input type="text" name="daterange" class="form-control"
                                            value="" required/>
                                            <label for="floatingInput">Checkin - Checkout</label>
                                        
                                            <input type="hidden" class="form-control" name="checkin"
                                                style=" font-weight: 700; font-size: 17px;" id="floatingInput1"
                                                required>

                                            <input type="hidden" class="form-control" name="checkout"
                                                style="font-weight: 700; font-size: 17px;" id="floatingInput2" >
                                            
                                        
                                        </div>
                                    </div>

                                    
                                    

                                    
                                    <div class="col-md-2 col-lg-2 col-sm-12 p-2">
                                        <div class="form-floating">
                                            <input type="number" name="guests" class="form-control"  placeholder="Guests">
                                            <label class="form-label">Guests</label>
                                            
                                        </div>
                                    </div>

                                    <div class="col-md-2 col-sm-12 col-lg-2 text-center py-2">
                                        
                                             <button type="submit" class="btn btn-success form-control btn-lg">Search</button>
                                             
                                    
                                       
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
            <h3 class="mt-5">{{$listings->count()}} Properties Found</h3>
            <a href="" class="mt-5" style="color: #158E72; font-weight: 700;">View all</a>
        </div>
        <div class="card-header d-flex justify-content-between mb-3">
            <button class="btn btn-secondary">Popularity</button>
            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">Filters</button>
        </div>
        <div class="row mb-5">
            @foreach ($listings as $item)
            <div class="col-md-3 py-2">


                <a class="card" href="/client/single-listing/{{$item->listing_id}}">
                    <img src="#" class="card-img-top" id="card-image-view"
                        alt="#">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h6 class="card-title">{{$item->listing_title}}</h6>
                               
                            </div>
                            <div class="col" style="text-align: right">
                                @if (count($item->reviews) > 0)

                                    <div>
                                        <i class="fa fa-star checked mx-1"></i><span class="card-text"> {{$item->reviews[0]->avg_rating}}</span> 
                                    </div>
                                  
                                    
                                @else

                                    <div>
                                        <i class="fa fa-star checked mx-1"></i><span class="text-muted"> 0</span> 
                                    </div>
                                    
                                    
                                @endif
                                
                            </div>
                        </div>
                            @if ($item->allow_short_stay == true )
                            <p class="card-text">
                                Short stay available
                            </p>
                            @else
                            <p class="card-text">
                                Short stay not available
                            </p>
                            @endif
                            
                            <p class="card-text">{{$item->bed_num}} bedrooms</p>
                            
                            <p class="card-text">
                                ৳ {{$item->full_day_price_set_by_user}} <span>/ Night</span>
                            </p>
                    </div>
                </a>

                
            </div>
            @endforeach
            
            

        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Filters</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="input-group mb-3">
                            <h5 class="input-group title mb-3">Property Type</h5>
                            <div class="my-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                        id="inlineRadio1" value="option1">
                                    <label class="form-check-label" for="inlineRadio1">Room</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                        id="inlineRadio2" value="option2">
                                    <label class="form-check-label" for="inlineRadio2">Hotel</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                        id="inlineRadio3" value="option3">
                                    <label class="form-check-label" for="inlineRadio3">Apartment</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                        id="inlineRadio4" value="option4">
                                    <label class="form-check-label" for="inlineRadio4">Parking</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                        id="inlineRadio5" value="option5">
                                    <label class="form-check-label" for="inlineRadio5">Experience</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                        id="inlineRadio6" value="option6">
                                    <label class="form-check-label" for="inlineRadio6">Storage</label>
                                </div>
                            </div>

                        </div>
                        <div class="input-group mb-5">
                            <h5 class="input-group title">Price Range</h5>
                            <input type="number" class="p-2 my-2" placeholder="min">
                            <span class="p-2 mx-2">to</span>
                            <input type="number" class="p-2 my-2" placeholder="max">
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
                                                data-field="bedrooms">
                                            <input type="number" max="10" value="1" name="bedrooms"
                                                class="quantity-field border-0 text-center w-25">
                                            <input type="button" value="+"
                                                class="button-plus border rounded-circle icon-shape icon-sm "
                                                data-field="bedrooms">
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
                                                data-field="bathrooms">
                                            <input type="number" max="10" value="1" name="bathrooms"
                                                class="quantity-field border-0 text-center w-25">
                                            <input type="button" value="+"
                                                class="button-plus border rounded-circle icon-shape icon-sm "
                                                data-field="bathrooms">
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
                                                data-field="guests">
                                            <input type="number" max="10" value="1" name="guests"
                                                class="quantity-field border-0 text-center w-25">
                                            <input type="button" value="+"
                                                class="button-plus border rounded-circle icon-shape icon-sm "
                                                data-field="guests">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <h5 class="input-group title">Short Stay Allow</h5>
                            <span>
                                <input type="hidden" name="shortstay" value="0">
                                <input type="checkbox" name="shortstay" value="1">
                            </span>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Apply Filter</button>
                </div>
            </div>
        </div>
    </div>



    <!--send us messege-->
    <div style="background-color: #F2F2F2; width: 100%;">
        
        <!--Footer-->
        <div class="container py-5">
            
            <div class="row p-5 my-3 align-items-center">
                
                <div class="col-md-3 col-lg-3 col-sm-12 px-2">
                    <img src="../public/assets/img/logo/Jayga Logo-02.png" width="80" height="80" alt="Jayga">
                    <div style="width: 100%; color: black; font-size: 15px;  font-weight: 400; word-wrap: break-word">Bangladesh’s first peer to peer technology enabled spacing solution platform</div>
                    
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


    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
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

        $('.button-plus').on('click', function (e) {
            incrementValue(e);
        });

        $('.button-minus').on('click', function (e) {
            decrementValue(e);
        });

    </script>

<script>

                

    $(function() {

        var date1 = document.getElementById('floatingInput1');
        var date2 = document.getElementById('floatingInput2');
       
        
      

        

        $('input[name="daterange"]').daterangepicker({
            opens: 'left',
           

            locale: {
                cancelLabel: 'Clear'
            }
            
        }, function(start, end, label) {


           // console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') );
            date1.value = start.format('YYYY-MM-DD');
            date2.value = end.format('YYYY-MM-DD');



           
        });

            $('input[name="daterange"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });
        });
</script>
</body>
</html>