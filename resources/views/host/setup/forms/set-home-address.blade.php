@extends('host.setup.host-setup')
@section('content')
<div class="left-side">
    <div class="left-heading">
        <img src="{{asset('assets/img/logo/jayga-01.png')}}" alt="" style="width: 100px; height: 100px;" srcset="">
        <span style="font-weight: 900;">Host Setup</span>
    </div>
    <div class="steps-content">
        <h3>Step <span class="step-number">9</span></h3>
        <p class="step-number-content active">Please complete your account information to host your own place.</p>
        <p class="step-number-content d-none">Whether it’s a room for stay or an experience to offer, Jayga has got you covered</p>
        <p class="step-number-content d-none">Provide basic info about your house</p>
        
        <p class="step-number-content d-none">You’ll add more details later, such as bed types.</p>
        <p class="step-number-content d-none">Tell guests what your place has to offer</p>
        <p class="step-number-content d-none">What are not allowed?</p>
        <p class="step-number-content d-none">Make it stand out with some images</p>
        
       
    </div>
    <ul class="progress-bar">
        <li class="active">Personal Information</li>
        <li class="active">Hosting Type</li>
        <li class="active">Basic Listing info</li>
        <li class="active">Share some info about your place</li>
        <li class="active">Amenities for guests</li>
        <li class="active">Restrictions for guests</li>
        <li class="active">Upload Listing Images</li>
        
        
    </ul>
    

    
</div>
<div class="right-side">
    
    
            <div class="main active">
                <small><img src="{{asset('assets/img/logo/jayga-appicon1.png')}}" style="width: 50px; height: 50px;" alt="" srcset=""></small>
                <div class="text">
                    <h2>Set your home address</h2>
                    <p>Set your home address and price for a day</p>
                </div>
                <form action="{{route('setaddress')}}" method="POST">
                    @csrf
                <div class="input-text">
                    <textarea type="text" name="street_address" class="form-control" placeholder="Street address" required require></textarea>
                </div>
                <div class="input-text">
                    <input type="text" name="town" placeholder="Town">
                </div>
                <div class="input-text">
                    <input type="text" name="city" placeholder="City">
                </div>
                
                <div class="input-text">
                    <input type="number" name="zip" placeholder="Zip code">
                </div>
                <div class="input-text">
                    <input type="text" name="price" placeholder="Price for a day">
                </div>
                <div class="buttons button_space">
                    <a href="{{route('step8')}}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="next_button">Publish</button>
                </div>
                </form>
            </div>

   
    
     

  



</div>
@endsection