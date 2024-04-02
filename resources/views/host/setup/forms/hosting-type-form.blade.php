@extends('host.setup.host-setup')
@section('content')
<div class="left-side">
    <div class="left-heading">
        <a href="{{route('userdash')}}"><img src="{{asset('assets/img/logo/jayga-01.png')}}" alt="" style="width: 100px; height: 100px;" srcset=""></a>
        <span style="font-weight: 900;">Host Setup</span>
    </div>
    <div class="steps-content">
        <h3>Step <span class="step-number">1</span></h3>
        
        <p class="step-number-content active">Whether it’s a room for stay or an experience to offer, Jayga has got you covered</p>
        <p class="step-number-content d-none">Provide basic info about your house</p>
        
        <p class="step-number-content d-none">You’ll add more details later, such as bed types.</p>
        <p class="step-number-content d-none">Tell guests what your place has to offer</p>
        <p class="step-number-content d-none">What are not allowed?</p>
        <p class="step-number-content d-none">Make it stand out with some images</p>
        
       
    </div>
    <ul class="progress-bar">
       
        <li class="active">Hosting Type</li>
        <li>Basic Listing info</li>
        <li>Share some info about your place</li>
        <li >Attach NID Documents</li>
        <li>Amenities for guests</li>
        <li>Restrictions for guests</li>
        <li>Upload Listing Images</li>
        
        
    </ul>
    

    
</div>
<div class="right-side">
    
    
            
            <div class="main active">
                <small><img src="{{asset('assets/img/logo/jayga-appicon1.png')}}" style="width: 50px; height: 50px;" alt="" srcset=""></small>
                <div class="text">
                    <h2>What type of property are you listing?</h2>
                    <p>Whether it’s a room for stay or an experience to offer, Jayga has got you covered</p>
                </div>
                <div class="input-text">
                    <select name="type_select" required>
                        <option>Select hosting type</option>
                        <option>Accomodation</option>
                        <option>Experience</option>
                    
                    </select>
                
                </div>
            
                
                <div class="buttons button_space">
                    
                    <a href="{{route('step3')}}" class="btn btn-primary">Next Step</a>
                </div>
            </div>

           
    
     

  



</div>
@endsection