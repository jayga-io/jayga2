@extends('host.setup.host-setup')
@section('content')
<div class="left-side">
    <div class="left-heading">
        <a href="{{route('userdash')}}"><img src="{{asset('assets/img/logo/jayga-01.png')}}" alt="" style="width: 100px; height: 100px;" srcset=""></a>
        <span style="font-weight: 900;">Host Setup</span>
    </div>
    <div class="steps-content">
        <h3>Step <span class="step-number">4</span></h3>
        
        <p class="step-number-content d-none">Whether it’s a room for stay or an experience to offer, Jayga has got you covered</p>
        <p class="step-number-content d-none">Provide basic info about your house</p>
        
        <p class="step-number-content d-none">You’ll add more details later, such as bed types.</p>
        <p class="step-number-content d-none">Tell guests what your place has to offer</p>
        <p class="step-number-content d-none">What are not allowed?</p>
        <p class="step-number-content d-none">Make it stand out with some images</p>
        
       
    </div>
    <ul class="progress-bar">
        
        <li class="active">Hosting Type</li>
        
        <li class="active">Basic Listing info</li>
        <li class="active">Share some info about your place</li>
        <li class="active">Attach NID Documents</li>
        <li>Amenities for guests</li>
        <li>Restrictions for guests</li>
        <li>Upload Listing Images</li>
        
        
    </ul>
    

    
</div>
<div class="right-side">
    
    

            <div class="main active">
                <small><img src="{{asset('assets/img/logo/jayga-appicon1.png')}}" style="width: 50px; height: 50px;" alt="" srcset=""></small>
                
                    <div class="text">
                        <h2>Please attach documents</h2>
                        <p>Please upload 3 files including your NID(Front/Back) and a copy of utility bill</p>
                    </div>
                    <form action="{{route('uploadfiles')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                    
                        <div class="input-text py-3">
                            <div class="input-div">
                                <label for="nid">Attach NID Front</label>
                                <input type="file" name="nid[]" multiple required />
                            </div>

                            <div class="input-div">
                                <label for="nid">Attach utility bill copy</label>
                                <input type="file" name="utility[]" multiple required />
                            </div>
                            
                        </div>
                        <div class="input-text py-2">
                            <div class="input-div">
                                <label for="nid">Attach NID back</label> <br>
                                <input type="file" name="nid2[]" multiple required />
                            </div>
                            
                        </div>
                       
                    
                    <div class="buttons button_space">
                        <a href="{{route('correctinfos')}}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary">Next Step</button>
                    </div>
                </form>
                
            </div>
            
   
    
     

  



</div>
@endsection