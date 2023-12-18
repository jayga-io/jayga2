@extends('host.setup.host-setup')
@section('content')
<div class="left-side">
    <div class="left-heading">
        <a href="{{route('userdash')}}"><img src="{{asset('assets/img/logo/jayga-01.png')}}" alt="" style="width: 100px; height: 100px;" srcset=""></a>
        <span style="font-weight: 900;">Host Setup</span>
    </div>
    <div class="steps-content">
        <h3>Step <span class="step-number">5</span></h3>
        
        <p class="step-number-content d-none">Whether it’s a room for stay or an experience to offer, Jayga has got you covered</p>
        <p class="step-number-content d-none">Provide basic info about your house</p>
        
        <p class="step-number-content d-none">You’ll add more details later, such as bed types.</p>
        <p class="step-number-content active">Tell guests what your place has to offer</p>
        <p class="step-number-content d-none">What are not allowed?</p>
        <p class="step-number-content d-none">Make it stand out with some images</p>
        
       
    </div>
    <ul class="progress-bar">
        
        <li class="active">Hosting Type</li>
       
        <li class="active">Basic Listing info</li>
        <li class="active">Share some info about your place</li>
        <li class="active">Attach NID Documents</li>
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
                <form action="{{route('changeamenities')}}" method="POST">
                    @csrf
                <div class="input-text">
                    <div class="input-div">
                        
                    
                        <input type="hidden" name="wifi" value="0">
                        @if (Session::get('wifi') == 0)
                            <input type="checkbox" name="wifi" value="1">
                        @else
                        <input type="checkbox" name="wifi" checked value="1">
                        @endif
                        
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
                        @if (Session::get('kitchen') == 0)
                        <input type="checkbox" name="kitchen" value=1 >
                        @else
                            <input type="checkbox" name="kitchen" checked value=1 >
                        @endif
                        
                        <label>Kitchen</label>
                    </div>
                    <div class="input-div">
                        <input type="hidden" name="washing_machine" value="0">
                        @if (Session::get('washing_machine') == 0)
                            <input type="checkbox" name="washing_machine" value=1 >
                        @else
                        <input type="checkbox" name="washing_machine" checked value=1 >
                        @endif
                        
                        <label>Washing Machine</label>
                    </div>
                </div>
                <div class="input-text">
                    <div class="input-div">
                        <input type="hidden" name="free_parking" value="0">
                        @if (Session::get('free_parking') == 0)
                            <input type="checkbox" name="free_parking" value=1>
                        @else
                        <input type="checkbox" name="free_parking" checked value=1>
                        @endif
                        
                        <label >Free Parking</label>
                    </div>
                    <div class="input-div">
                        <input type="hidden" name="breakfast_included" value="0">
                        @if (Session::get('breakfast_included') == 0)
                            <input type="checkbox" name="breakfast_included" value=1>
                        @else
                        <input type="checkbox" name="breakfast_included" checked value=1>
                        @endif
                        
                        <label for="">Breakfast Included</label>
                    </div>
                </div>
                <div class="input-text">
                    <div class="input-div">
                        <input type="hidden" name="air_condition" value="0">
                        @if (Session::get('air_condition'))
                            <input type="checkbox" name="air_condition" value=1>
                        @else
                        <input type="checkbox" name="air_condition" checked value=1>
                        @endif
                        
                        <label for="">Air Condition</label>
                    </div>
                    <div class="input-div">
                        <input type="hidden" name="dedicated_workspace" value="0">
                        @if (Session::get('dedicated_workspace') == 0)
                            <input type="checkbox" name="dedicated_workspace" value=1 data-toggle="toggle" data-onstyle="success"
                            data-offstyle="danger">
                        @else
                        <input type="checkbox" name="dedicated_workspace" checked value=1 data-toggle="toggle" data-onstyle="success"
                        data-offstyle="danger">
                        @endif
                        
                            <label for="">Dedicated Workspace</label>
                    </div>
                </div>
                <div class="input-text">
                    <div class="input-div">
                        <input type="hidden" name="gym" value="0">
                        @if (Session::get('gym') == 0)
                            <input type="checkbox" name="gym" value=1 >
                        @else
                        <input type="checkbox" checked name="gym" value=1 >
                        @endif
                        
                        <label for="">Gym</label>
                    </div>
                    <div class="input-div">
                        <input type="hidden" name="beach_lake_access" value="0">
                        @if (Session::get('beach_lake_access') == 0)
                            <input type="checkbox" name="beach_lake_access" value=1 >
                        @else
                        <input type="checkbox" checked name="beach_lake_access" value=1 >
                        @endif
                            
                            <label for="">Beach Access</label>
                    </div>
                </div>
                <div class="input-text">
                    <div class="input-div">
                        <input type="hidden" name="fire_extinguish" value="0">
                        @if (Session::get('fire_extinguish') == 0)
                            <input type="checkbox" name="fire_extinguish" value=1 data-toggle="toggle" data-onstyle="success"
                            data-offstyle="danger">
                        @else
                        <input type="checkbox" name="fire_extinguish" checked value=1 data-toggle="toggle" data-onstyle="success"
                        data-offstyle="danger">
                        @endif
                        
                        <label>Fire Ext</label>
                    </div>
                    <div class="input-div">
                        <input type="hidden" name="cctv" value="0">
                        @if (Session::get('cctv') == 0)
                            <input type="checkbox" name="cctv" value=1 data-toggle="toggle" data-onstyle="success"
                                    data-offstyle="danger">
                        @else
                        <input type="checkbox" name="cctv" checked value=1 data-toggle="toggle" data-onstyle="success"
                        data-offstyle="danger">
                        @endif
                        
                            <label for="">CCTV</label>
                    </div>
                </div>
                
            
                <div class="buttons button_space">
                    <a href="{{route('step5')}}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="next_button">Next Step</button>
                </div>
                </form>
            </div>
        
   
    
     

  



</div>
@endsection