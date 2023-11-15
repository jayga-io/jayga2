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
        <li class="active">Personal Information</li>
        <li class="active">Hosting Type</li>
        
        <li class="active">Basic Listing info</li>
        <li class="active">Share some info about your place</li>
        <li>Amenities for guests</li>
        <li>Restrictions for guests</li>
        <li>Upload Listing Images</li>
        
        
    </ul>
    

    
</div>
<div class="right-side">
    
    
         
            <div class="main active">
                <small><img src="{{asset('assets/img/logo/jayga-appicon1.png')}}" style="width: 50px; height: 50px;" alt="" srcset=""></small>
                <div class="text">
                    <h2>Share some info about your place</h2>
                    <p>You'll add more details later</p>
                </div>
                <form action="{{route('listinginfo')}}" method="POST">
                    @csrf
                
                    <div class="input-text">
                        <div class="row">
                            <div class="col-md-12">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="text-dark">Guests</p>
                                </div>
                                <div class="input-group w-auto justify-content-end align-items-center">
                                    <input type="button" value="-"  class="button-minus border rounded-circle  icon-shape icon-sm mx-1 " data-field="guest_num">
                                    <input type="number" step="1" max="10" value="1" name="guest_num" class="quantity-field border-0 text-center w-25">
                                    <input type="button" value="+"  class="button-plus border rounded-circle icon-shape icon-sm " data-field="guest_num">
                                </div>
                            </div>
                            </div>
                            <div class="col-md-12">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="text-dark">Bedroom</p>
                                </div>
                                <div class="input-group w-auto justify-content-end align-items-center">
                                    <input type="button"  value="-" class="button-minus border rounded-circle  icon-shape icon-sm mx-1 " data-field="bed_num">
                                    <input type="number" step="1" max="10" value="1" name="bed_num" class="quantity-field border-0 text-center w-25">
                                    <input type="button"  value="+" class="button-plus border rounded-circle icon-shape icon-sm lh-0" data-field="bed_num">
                                </div>
                            </div>
                            </div>
                            <div class="col-md-12">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="text-dark">Bathroom</p>
                                </div>
                                <div class="input-group w-auto justify-content-end align-items-center">
                                    <input type="button" value="-"  class="button-minus border rounded-circle  icon-shape icon-sm mx-1 lh-0" data-field="bathroom_num">
                                    <input type="number" step="1" max="10" value="1" name="bathroom_num" class="quantity-field border-0 text-center w-25">
                                    <input type="button" value="+"  class="button-plus border rounded-circle icon-shape icon-sm lh-0" data-field="bathroom_num">
                                </div>
                            </div>
                            </div>
                            <div class="col-md-12 ">
                                <p class="mt-5">Will you allow short stay?</p>
                                <div class="input-text">
                                    
                                    <input type="hidden" name="allow_short_stay"  value="0">
										<input type="checkbox" name="allow_short_stay" value="1" data-toggle="toggle"
											data-onstyle="success" data-offstyle="danger">
                                    
                                </div>
                            </div>
                            </div>
                    </div>
                
            
                
                <div class="buttons button_space">
                    <a href="{{route('step3')}}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="next_button">Next Step</button>
                </div>
                </form>
            </div>

           
     

  
           

</div>

@endsection