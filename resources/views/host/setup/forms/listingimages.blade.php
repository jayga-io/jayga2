@extends('host.setup.host-setup')
@section('content')
<div class="left-side">
    <div class="left-heading">
        <img src="{{asset('assets/img/logo/jayga-01.png')}}" alt="" style="width: 100px; height: 100px;" srcset="">
        <span style="font-weight: 900;">Host Setup</span>
    </div>
    <div class="steps-content">
        <h3>Step <span class="step-number">7</span></h3>
        
        <p class="step-number-content d-none">Whether it’s a room for stay or an experience to offer, Jayga has got you covered</p>
        <p class="step-number-content d-none">Provide basic info about your house</p>
        
        <p class="step-number-content d-none">You’ll add more details later, such as bed types.</p>
        <p class="step-number-content d-none">Tell guests what your place has to offer</p>
        <p class="step-number-content d-none">What are not allowed?</p>
        <p class="step-number-content active">Make it stand out with some images</p>
        
       
    </div>
    <ul class="progress-bar">
        
        <li class="active">Hosting Type</li>
        <li class="active">Basic Listing info</li>
        <li class="active">Share some info about your place</li>
        <li class="active">Attach NID Documents</li>
        <li class="active">Amenities for guests</li>
        <li class="active">Restrictions for guests</li>
        <li class="active">Upload Listing Images</li>
        
        
    </ul>
    

    
</div>
<div class="right-side">
            
            
            
            <div class="main active">
                <small><img src="{{asset('assets/img/logo/jayga-appicon1.png')}}" style="width: 50px; height: 50px;" alt="" srcset=""></small>
                <div class="text">
                    <h2>Make it stand out</h2>
                    <p>Add some photos to your listing. You can add as many you want</p>
                </div>
                <form action="{{route('listingimages')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="user_card">
                <div class="input-text">
                    <input type="file" name="listingimages[]" multiple />
                </div>
                </div>
                <div class="buttons button_space">
                    <a href="{{route('correctrestrictions')}}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="next_button">Next</button>
                </div>
                </form>
            </div>
          
   
    
     

  



</div>
@endsection