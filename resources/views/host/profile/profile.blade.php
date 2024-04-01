<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <title>Jayga | Profile Settings</title>
</head>

<body>

    <div class="container rounded bg-white mt-5 mb-5">
        <form action="{{route('createuserprofile')}}" class="form-control" method="POST" enctype="multipart/form-data">
            @csrf
           @if (session()->has('messege'))
           <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('messege') }}</strong>
            
        </div> 
           @endif 
        <div class="row">
            
            <div class="col-md-3 border-right">
                <img class="px-3" style="float: right;" src="{{asset('assets/img/logo/Jayga Logo-02.png')}}" width="150"
                    height="130" alt="logo" />
                <div class="d-flex flex-column  p-2 " style="float: right;">
                    @if (count($dp) == 0)
                        <img class="rounded-circle mt-0"
                        width="150px"
                        src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                    @else
                    <img class="rounded-circle mt-0"
                    width="150px" height="150px"
                    src="{{asset('/uploads/'.$dp[0]->user_targetlocation)}}">
                    @endif
                    
                        
                        <span
                        class="font-weight-bold">{{$user[0]->name}}</span><span
                        class="text-black-50">{{$user[0]->email}}</span><span> </span></div>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <h4 class="text-right">Profile Settings</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label class="labels">Name</label>
                            @if ($user[0]->name == null)
                                <input type="text" name="username" class="form-control"
                                placeholder="Name" value="" required>
                            @else
                                <input type="text" name="username" class="form-control"
                                placeholder="{{$user[0]->name}}" value="{{$user[0]->name}}" required>
                            @endif
                            
                            </div>
                     
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 mb-3">
                            <label class="labels">Mobile Number</label>
                            <input type="text"
                                class="form-control" name="phone" placeholder="{{$user[0]->phone}}" value="{{$user[0]->phone}}" ></div>

                        <div class="col-md-12 mb-3"><label class="labels">Address</label><input type="text"
                                class="form-control" name="address" placeholder="enter address" value=""></div>
                     
                        <div class="col-md-12 mb-3"><label class="labels">Email</label>
                            <input type="text" class="form-control" name="email" placeholder="{{$user[0]->email}}" value="{{$user[0]->email}}" required>
                        </div>
                        <div class="col-md-12 mb-3"><label class="labels">Date of Birth</label><input type="date"
                                class="form-control" name="dob" placeholder="{{$user[0]->user_dob}}" value="{{$user[0]->user_dob}}"></div>
                        
                    </div>
                    <div class="row mt-3">
                        
                    </div>
                    
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center experience">
                        <span>Upload profile Picture</span>
                        <span class="border px-1 p-1 add-experience"><i
                                class="fa fa-plus"></i><input type="file" name="profile_picture" class=" form-control"></span>
                            </div>
                            <br>
                    <div class="col-md-12">
                        <label class="labels">Upload User NID (Front)</label>
                        <input type="file" name="nid"
                            class="form-control" required/>
                        </div> <br>
                    <div class="col-md-12"><label class="labels">Additional Details</label><input type="text"
                            class="form-control" placeholder="additional details" value=""></div>
                </div>
            </div>
            <div class="m-3 text-center">
                <button class="btn btn-primary profile-button" type="submit">Save Profile</button>
                <a href="{{route('backroute')}}" class="btn btn-secondary">Back to home</a>
                <a href="{{route('userdash')}}" class="btn btn-success">Back to Dashboard</a>
            </div>
        </div>
    </form>
    </div>
    </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>