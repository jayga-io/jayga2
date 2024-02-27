<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
   
    <title>Jayga | My Bookings</title>
</head>

<body>
    @include('navbar')
    <div class="container rounded bg-white mt-5 mb-5">

        @if (session()->has('messege'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('messege') }}</strong>

        </div>
        @endif
        
        <h2>My Bookings</h2>

        @if (count($listings)>0)
            <div class="container px-5" style="overflow-y: scroll; overflow-x:hidden; height: 500px;">
                @foreach ($listings as $item)
            
                <div class="card my-5">
                   
                    <div class="card-header d-flex justify-content-between">
                        <p>Status: <span>Approved</span></p>
                        <p>{{$item->created_at->diffForHumans()}}</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
            
                            <div class="col-md-4 border-right">
                                <img src="https://new.jayga.io/uploads/{{$item->listing_images[0]->listing_targetlocation}}"
                                    style="width: 100%; height:100%; object-fit:contain" alt="">
                            </div>
                            <div class="col-md-5 border-right">
                                <h5>{{$item->listings->listing_title}}</h5>
                                <p class="my-5">Booking ID: <span>{{$item->booking_id}}</span></p>
                                <div>
                                    <p>{{$item->total_members}} Guests</p>
                                    <p>Checkin : <span>{{$item->date_enter}}</span> | <span>Checkout:
                                            <span>{{$item->date_exit}}</span></span></p>
                                </div>
                                <a class="btn btn-success my-3" href="/client/single-listing/{{$item->listings->listing_id}}">Review
                                    Listing</a>
                            </div>
                            <div class="col-md-3 d-flex my-5">
                                <div class="mx-3">
                                    <p>৳ {{$item->listings->full_day_price_set_by_user}} * {{$item->days_stayed}} Nights</p>
                                    <p>Jayga Service fee</p>
                                    <p>Total</p>
                                </div>
                                <div class="mx-3">
                                    <p>৳ {{$item->net_payable}}</p>
                                    <p>3%</p>
                                    <p>৳ {{$item->pay_amount}}</p>
                                </div>
                            </div>
            
            
            
                        </div>
                    </div>
                </div>
            
            
                @endforeach
            </div>
            
            
            <div class="m-3 text-center">
            
                <a href="{{route('backroute')}}" class="btn btn-secondary">Back to home</a>
                <a href="{{route('userdash')}}" class="btn btn-success">Back to Dashboard</a>
            </div>
        @else
            <div class="container mb-5">
                <p>No Bookings Found!</p>
            </div>
            <div class="my-5 text-center">
            
                <a href="{{route('backroute')}}" class="btn btn-secondary">Back to home</a>
                <a href="{{route('userdash')}}" class="btn btn-success">Back to Dashboard</a>
            </div>
        @endif
        
            
       
    </div>
   

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>