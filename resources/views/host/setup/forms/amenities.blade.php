@extends('host.setup.host-setup')
@section('content')
<div class="left-side">
    <div class="left-heading">
        <img src="{{asset('assets/img/logo/jayga-01.png')}}" alt="" style="width: 100px; height: 100px;" srcset="">
        <span style="font-weight: 900;">Host Setup</span>
    </div>
    <div class="steps-content">
        <h3>Step <span class="step-number">6</span></h3>
        <p class="step-number-content active">Please complete your account information to host your own place.</p>
        <p class="step-number-content d-none">Whether it’s a room for stay or an experience to offer, Jayga has got you covered</p>
        <p class="step-number-content d-none">Provide basic info about your house</p>
        
        <p class="step-number-content d-none">You’ll add more details later, such as bed types.</p>
        <p class="step-number-content d-none">Tell guests what your place has to offer</p>
        <p class="step-number-content d-none">What are not allowed?</p>
        <p class="step-number-content d-none">Make it stand out with some images</p>
        
       
    </div>
    <ul class="progress-bar">
        <li>Personal Information</li>
        <li>Hosting Type</li>
        <li>Lister Owners Verification</li>
        <li>Basic Listing info</li>
        <li>Share some info about your place</li>
        <li class="active">Amenities for guests</li>
        <li>Restrictions for guests</li>
        <li>Upload Listing Images</li>
        
        
    </ul>
    

    
</div>
<div class="right-side">
    
    
            <div class="main active">
                <small><img src="{{asset('assets/img/logo/jayga-appicon1.png')}}" style="width: 50px; height: 50px;" alt="" srcset=""></small>
                <div class="text">
                    <h2>Amenities</h2>
                    <p>Tell guests what your place has to offer</p>
                </div>
                <div class="input-text">
                    <div class="input-div">
                        
                    
                        <input type="hidden" name="wifi" value="0">
                        <input type="checkbox" name="wifi" value="1">
                        <label>Wifi</label>
                    </div>
                    <div class="input-div"> 
                    <input type="hidden" name="tv" value="0">
                        <input type="checkbox" name="tv" value=1 >
                        <label>TV</label>
                    </div>
                </div>
                <div class="input-text">
                    <div class="input-div">
                        <input type="hidden" name="kitchen" value="0">
                        <input type="checkbox" name="kitchen" value=1 >
                        <label>Kitchen</label>
                    </div>
                    <div class="input-div">
                        <input type="hidden" name="washing_machine" value="0">
                        <input type="checkbox" name="washing_machine" value=1 >
                        <label>Washing Machine</label>
                    </div>
                </div>
                <div class="input-text">
                    <div class="input-div">
                        <input type="hidden" name="free_parking" value="0">
                        <input type="checkbox" name="free_parking" value=1>
                        <label >Free Parking</label>
                    </div>
                    <div class="input-div">
                        <input type="hidden" name="breakfast_included" value="0">
                        <input type="checkbox" name="breakfast_included" value=1>
                        <label for="">Breakfast Included</label>
                    </div>
                </div>
                <div class="input-text">
                    <div class="input-div">
                        <input type="hidden" name="air_condition" value="0">
                        <input type="checkbox" name="air_condition" value=1>
                        <label for="">Air Condition</label>
                    </div>
                    <div class="input-div">
                        <input type="hidden" name="dedicated_workspace" value="0">
                        <input type="checkbox" name="dedicated_workspace" value=1 data-toggle="toggle" data-onstyle="success"
                            data-offstyle="danger">
                            <label for="">Dedicated Workspace</label>
                    </div>
                </div>
                <div class="input-text">
                    <div class="input-div">
                        <input type="hidden" name="gym" value="0">
                        <input type="checkbox" name="gym" value=1 >
                        <label for="">Gym</label>
                    </div>
                    <div class="input-div">
                        <input type="hidden" name="beach_lake_access" value="0">
                            <input type="checkbox" name="beach_lake_access" value=1 >
                            <label for="">Beach Access</label>
                    </div>
                </div>
                <div class="input-text">
                    <div class="input-div">
                        <input type="hidden" name="fire_extinguish" value="0">
                        <input type="checkbox" name="fire_extinguish" value=1 data-toggle="toggle" data-onstyle="success"
                            data-offstyle="danger">
                        <label>Fire Ext</label>
                    </div>
                    <div class="input-div">
                        <input type="hidden" name="cctv" value="0">
                        <input type="checkbox" name="cctv" value=1 data-toggle="toggle" data-onstyle="success"
                                    data-offstyle="danger">
                            <label for="">CCTV</label>
                    </div>
                </div>
                
            
                <div class="buttons button_space">
                    <button class="back_button">Back</button>
                    <button class="next_button">Next Step</button>
                </div>
            </div>
        
   
    
     

  



</div>
@endsection