@extends('host.setup.host-setup')
@section('content')
<div class="left-side">
    <div class="left-heading">
        <img src="{{asset('assets/img/logo/jayga-01.png')}}" alt="" style="width: 100px; height: 100px;" srcset="">
        <span style="font-weight: 900;">Host Setup</span>
    </div>
    <div class="steps-content">
        <h3>Step <span class="step-number">3</span></h3>
       
        <p class="step-number-content d-none">Whether it’s a room for stay or an experience to offer, Jayga has got you covered</p>
        <p class="step-number-content active">Provide basic info about your house</p>
        
        <p class="step-number-content d-none">You’ll add more details later, such as bed types.</p>
        <p class="step-number-content d-none">Tell guests what your place has to offer</p>
        <p class="step-number-content d-none">What are not allowed?</p>
        <p class="step-number-content d-none">Make it stand out with some images</p>
        
       
    </div>
    <ul class="progress-bar">
        
        <li class="active">Hosting Type</li>
        
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
                <form action="{{route('changelisting')}}" method="POST">
                    @csrf
                    <div class="text">
                        <h2>Now, let’s give your house a intro</h2>
                        <p>Short titles work best. Have fun with it - you can always change it later</p>
                    </div>
                    <div class="input-text">
                        <input type="text" name="listing_title" placeholder="{{Session::get('listing_title')}}" required require>
                        <span>House Title</span>
                    
                    </div>
                    <div class="input-text">
                        <textarea type="text" name="listing_description" class="form-control" placeholder="{{Session::get('listing_description')}}" required require></textarea>
                        <span>House Description</span>
                    
                    </div>
                    <h2>Describe your house</h2>
                    <div class="input-text">
                        <div class="input-div">
                            <input type="hidden" name="peaceful" value="0">
                            @if (Session::get('describe_peaceful') == 0)
                                <input type="checkbox" name="peaceful" value="1">
                            @else
                                <input type="checkbox" name="peaceful" checked value="1">
                            @endif
                                
                                
                                <label>peaceful</label>
                        </div>
                       <div class="input-div">
                            <input type="hidden" name="lively" value="0">
                            
                            <input type="checkbox" name="lively" value=1 data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
                            <label>Lively</label>
                       </div>
                    
                    </div>
                    
                    <div class="input-text">
                        <div class="input-div">
                                <input type="hidden" name="describe_familyfriendly" value="0">
                                @if (Session::get('describe_familyfriendly') == 0)
                                    <input type="checkbox" name="describe_familyfriendly" value=1  data-toggle="toggle" data-onstyle="success"
                                data-offstyle="danger">
                                @else
                                <input type="checkbox" name="describe_familyfriendly" value=1 checked  data-toggle="toggle" data-onstyle="success"
                                data-offstyle="danger">
                                @endif
                            
                            <label>Family friendly</label>
                        </div>
                        <div class="input-div">
                            <input type="hidden" name="door_lock" value="0">
                            @if (Session::get('door_lock') == 0)
                                <input type="checkbox" name="door_lock" value=1 data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
                            @else
                            <input type="checkbox" name="door_lock" value=1 data-toggle="toggle" checked data-onstyle="success" data-offstyle="danger">
                            @endif
                            
                            <label>Room Lock available?</label>
                        </div>
                    
                    </div>
                    
                    <div class="input-text">
                        <div class="input-div">
                            <input type="hidden" name="citycenter" value="0">
                            <input type="checkbox" name="citycenter" value=1 data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
                            <label>City Center</label>
                        </div>
                        <div class="input-div">
                            <input type="hidden" name="tourist_spot" value="0">
                            <input type="checkbox" name="tourist_spot" value=1 data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
                            <label>Tourist attraction nearby</label>
                        </div>
                    
                    </div>
                    
                    
                    <div class="input-text">
                        <label>Select Listing Type</label>
                        <select name="listing_type">
                            @if (Session::get('listing_type') == 0)
                                <option>Select</option>
                            @else
                                <option value="{{Session::get('listing_type')}}">{{Session::get('listing_type')}}</option>
                            @endif
                            
                            <option value="room">Room</option>
                            <option value="apartment">Apartment</option>
                            <option value="hotel">Hotel</option>
                            <option value="cabin">Cabin</option>
                            <option value="lounge">Lounge</option>
                            <option value="farm">Farm</option>
                            <option value="suit">Suit</option>
                    
                        </select>
                    
                    
                    </div>
                    
                    
                    
                    <div class="buttons button_space">
                        <a href="{{route('step2')}}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-success">Next Step</button>
                    </div>
                </form>
               
            </div>
           
     

  



</div>
@endsection