<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
   
    <title>Jayga | My Favourites</title>
</head>

<body>
    @include('navbar')
    <div class="container rounded bg-white mt-5 mb-5">

        @if (session()->has('messege'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('messege') }}</strong>

        </div>
        @endif
        
        <h2>My Favourites</h2>

        @if (count($favs)>0)
            <div class="container px-5" style="overflow-y: scroll; overflow-x:hidden; height: 500px;">
                @foreach ($favs as $item)
            
                <div class="card my-5">
                   
                    <div class="card-header d-flex justify-content-between">
                        <p>Listing ID: <span>{{$item->listing_id}}</span></p>
                        <p>{{$item->created_at->diffForHumans()}}</p>
                    </div>
                    <div class="card-body">
                        <div class="row" style="align-items: center">
                            
                            <div class="col-md-4 border-right">
                                <img src="https://new.jayga.io/uploads/{{$item->listing_image[0]->listing_targetlocation}}"
                                    style="width: 100%; height:100%; object-fit:contain" alt="">
                            </div>
                            
                            <div class="col-md-8 border-right ">
                                <h5>{{$item->listing->listing_title}}</h5>
                                <div class="d-flex">
                                    <p class="px-1"> {{$item->listing->guest_num}} Guests</p> &#8901; 
                                    <p class="px-1"> {{$item->listing->bed_num}} Bedrooms</p> &#8901; 
                                    <p class="px-1"> {{$item->listing->bathroom_num}} Bathrooms</p>
                                </div>
                               <p>
                                @if ($item->listing->allow_short_stay == 0)
                                    <span class="px-1" style="color: #158E72">Short stay not available</span>
                                @else
                                    <span class="px-1"  style="color: #158E72">Short stay available</span>
                                @endif
                               </p>
                               
                               <a href="/client/single-listing/{{$item->listing->listing_id}}" class="btn btn-success">View Listing</a>
                               <a href="/client/remove/favourite/{{$item->id}}" class="btn btn-secondary">Remove</a>
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
                <p>No Favourites Found!</p>
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