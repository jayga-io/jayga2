<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
   
    <title>Jayga | My Bookings</title>
</head>

<body>
    @include('navbar')
    <div class="container rounded bg-white mt-5 mb-5" style="padding-top: 100px;">

        @if (session()->has('messege'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('messege') }}</strong>

        </div>
        @endif
        
        <h2>Notifications</h2>

        @if (count($notifs)>0)
            <div class="container px-5" style="overflow-y: scroll; overflow-x:hidden; height: 500px;">
                @foreach ($notifs as $item)
            
                <div class="card my-5">
                   
                    <div class="card-header d-flex justify-content-between">
                        <p><span>{{$item->type}}</span></p>
                        <p>{{$item->created_at->diffForHumans()}}</p>
                    </div>
                    <div class="card-body">
                        <div class="row" style="align-items: center">
                            
                            <div class="col-md-2 border-right">
                                <img src="https://new.jayga.io/uploads/{{$item->listing_image[0]->listing_targetlocation}}"
                                    style="width: 100%; height:100%; object-fit:contain" alt="">
                            </div>
                            
                            <div class="col-md-10 border-right d-flex justify-content-between">
                                <h5>{{$item->messege}}</h5>
                               
                               
                               
                            </div>
                           
            
            
            
                        </div>
                    </div>
                </div>
            
            
                @endforeach
            </div>
            
            
            <div class="m-3 text-center">
                
                <a href="{{route('backroute')}}" class="btn btn-secondary">Back to home</a>
                <a href="{{route('clearnotifs')}}" class="btn btn-primary">Clear all notifications</a>
                <a href="{{route('userdash')}}" class="btn btn-success">Back to Dashboard</a>
            </div>
        @else
            <div class="container mb-5">
                <p>No Notifications Found!</p>
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