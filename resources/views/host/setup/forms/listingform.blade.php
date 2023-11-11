@extends('host.setup.host-setup')
@section('content')
<div class="left-side">
    <div class="left-heading">
        <img src="{{asset('assets/img/logo/jayga-01.png')}}" alt="" style="width: 100px; height: 100px;" srcset="">
        <span style="font-weight: 900;">Host Setup</span>
    </div>
    <div class="steps-content">
        <h3>Step <span class="step-number">4</span></h3>
        <p class="step-number-content active">Please complete your account information to host your own place.</p>
        <p class="step-number-content d-none">Whether it’s a room for stay or an experience to offer, Jayga has got you covered</p>
        <p class="step-number-content d-none">Provide basic info about your house</p>
        
        <p class="step-number-content d-none">You’ll add more details later, such as bed types.</p>
        <p class="step-number-content d-none">Tell guests what your place has to offer</p>
        <p class="step-number-content d-none">What are not allowed?</p>
        <p class="step-number-content d-none">Make it stand out with some images</p>
        
       
    </div>
    <ul class="progress-bar">
        <li >Personal Information</li>
        <li>Hosting Type</li>
        <li>Lister Owner's Verification</li>
        <li class="active">Basic Listing info</li>
        <li>Share some info about your place</li>
        <li>Amenities for guests</li>
        <li>Restrictions for guests</li>
        <li>Upload Listing Images</li>
        
        
    </ul>
    

    
</div>
<div class="right-side">
    
    

            <div class="main active">
                <small><img src="{{asset('assets/img/logo/jayga-appicon1.png')}}" style="width: 50px; height: 50px;" alt="" srcset=""></small>
                <div class="text">
                    <h2>Now, let’s give your house a intro</h2>
                    <p>Short titles work best. Have fun with it - you can always change it later</p>
                </div>
                <div class="input-text">
                    <input type="text" name="listing_title" required require>
                        <span>House Title</span>
                
                </div>
                <div class="input-text">
                    <textarea type="text" name="listing_description" required require></textarea>
                        <span>House Description</span>
                
                </div>
                <h2>Describe your house</h2>
                <div class="input-text">
                
                    <input type="hidden" name="peaceful" value="0">
                        <input type="checkbox" name="peaceful" value="1">
                        <label>peaceful</label>
                
                </div>

                <div class="input-text">
                
                    <input type="hidden" name="describe_familyfriendly" value="0" >
                                <input type="checkbox" name="describe_familyfriendly" value=1 checked data-toggle="toggle"
                                    data-onstyle="success" data-offstyle="danger">
                        <label>Family friendly</label>
                
                </div>
                <div class="input-text">
                
                    <input type="hidden" name="door_lock" value="0" >
                                <input type="checkbox" name="door_lock" value=1 data-toggle="toggle" data-onstyle="success"
                                    data-offstyle="danger">
                        <label>Room Lock available?</label>
                
                </div>
                <div class="input-text" >
                    <label>Select Listing Type</label>
                    <select name="listing_type">
                        <option>Select</option>
                        <option>Room</option>
                        <option>Apartment</option>
                        <option>Hotel</option>
                        <option>Cabin</option>
                        <option>Lounge</option>
                        <option>Farm</option>
                        <option>Suit</option>
                        
                    </select>
                        
                
                </div>

            
                
                <div class="buttons button_space">
                    <button class="back_button">Back</button>
                    <button class="next_button">Next Step</button>
                </div>
            </div>
           
     

  



</div>
@endsection