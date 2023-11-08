<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('assets/css/host.css')}}">
</head>
<body>
    
    <div class="container">
        
        <div class="card">
            <div class="form">
                <div class="left-side">
                    <div class="left-heading">
                        <img src="{{asset('assets/img/logo/jayga-01.png')}}" alt="" style="width: 100px; height: 100px;" srcset="">
                        <span style="font-weight: 900;">Host Setup</span>
                    </div>
                    <div class="steps-content">
                        <h3>Step <span class="step-number">1</span></h3>
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
                        <li>Hosting Type</li>
                        <li>Basic Listing info</li>
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
                            <h2>Your Personal Information</h2>
                            <p>Enter your personal information to get closer to copanies.</p>
                        </div>
                        <div class="input-text">
                            <div class="input-div">
                                <input type="text" required require id="user_name">
                                <span>Name</span>
                            </div>
                            
                        </div>
                        <div class="input-text">
                            <div class="input-div">
                                <input type="text" required require>
                                <span>Phone number</span>
                            </div>
                            <div class="input-div">
                                <input type="text" required require>
                                <span>E-mail Address</span>
                            </div>
                        </div>
                       
                        <div class="buttons">
                            <button class=" next_button">Next Step</button>
                        </div>
                    </div>
                    <div class="main">
                        <small><img src="{{asset('assets/img/logo/jayga-appicon1.png')}}" style="width: 50px; height: 50px;" alt="" srcset=""></small>
                        <div class="text">
                            <h2>What type of property are you listing?</h2>
                            <p>Whether it’s a room for stay or an experience to offer, Jayga has got you covered</p>
                        </div>
                        <div class="input-text">
                            <select>
                                <option>Select hosting type</option>
                                <option>Accomodation</option>
                                <option>Experience</option>
                               
                            </select>
                           
                        </div>
                       
                        
                        <div class="buttons button_space">
                            <button class="back_button">Back</button>
                            <button class="next_button">Next Step</button>
                        </div>
                    </div>

                    <div class="main">
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
                            <textarea type="text" name="listing_title" required require></textarea>
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
                        <div class="input-text">
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
                    <div class="main">
                        <small><img src="{{asset('assets/img/logo/jayga-appicon1.png')}}" style="width: 50px; height: 50px;" alt="" srcset=""></small>
                        <div class="text">
                            <h2>Share some info about your place</h2>
                            <p>You'll add more details later</p>
                        </div>
                        
                        <div class="input-text">
                            <div class="input-text">
                                <div class="row">
                                    <div class="col-md-12">
                                       <div class="d-flex justify-content-between">
                                          <div>
                                             <p class="text-dark">Guests</p>
                                          </div>
                                          <div class="input-group w-auto justify-content-end align-items-center">
                                             <input type="button" value="-" class="button-minus border rounded-circle  icon-shape icon-sm mx-1 " data-field="quantity">
                                             <input type="number" step="1" max="10" value="1" name="quantity" class="quantity-field border-0 text-center w-25">
                                             <input type="button" value="+" class="button-plus border rounded-circle icon-shape icon-sm " data-field="quantity">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="d-flex justify-content-between">
                                          <div>
                                             <p class="text-dark">Bedroom</p>
                                          </div>
                                          <div class="input-group w-auto justify-content-end align-items-center">
                                             <input type="button" value="-" class="button-minus border rounded-circle  icon-shape icon-sm mx-1 " data-field="quantity">
                                             <input type="number" step="1" max="10" value="1" name="quantity" class="quantity-field border-0 text-center w-25">
                                             <input type="button" value="+" class="button-plus border rounded-circle icon-shape icon-sm lh-0" data-field="quantity">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="d-flex justify-content-between">
                                          <div>
                                             <p class="text-dark">Bathroom</p>
                                          </div>
                                          <div class="input-group w-auto justify-content-end align-items-center">
                                             <input type="button" value="-" class="button-minus border rounded-circle  icon-shape icon-sm mx-1 lh-0" data-field="quantity">
                                             <input type="number" step="1" max="10" value="1" name="quantity" class="quantity-field border-0 text-center w-25">
                                             <input type="button" value="+" class="button-plus border rounded-circle icon-shape icon-sm lh-0" data-field="quantity">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-md-12 ">
                                        <p class="mt-5">Will you allow short stay?</p>
                                        <div class="input-text">
                                            <label for="">No</label>
                                            <input type="checkbox" name="allow_short_stay" value="0">
                                            <label for="">Yes</label>
                                            <input type="checkbox" name="allow_short_stay" value="1">
                                            
                                        </div>
                                    </div>
                                    </div>
                            </div>
                        </div>
                       
                        
                        <div class="buttons button_space">
                            <button class="back_button">Back</button>
                            <button class="next_button">Next Step</button>
                        </div>
                    </div>

                    <div class="main">
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
                    <div class="main">
                        <small><img src="../public/assets/img/logo/jayga-appicon1.png" style="width: 50px; height: 50px;" alt="" srcset=""></small>
                        <div class="text">
                            <h2>Restrictions</h2>
                            <p>Let the guests know what are not allowed</p>
                        </div>
                        <div class="input-text">
                            <div class="input-div">
                                
                              
                                <input type="hidden" name="indoor_smoking" value="0">
                                <input type="checkbox" name="indoor_smoking" value=1 data-toggle="toggle" data-onstyle="success"
                                    data-offstyle="danger">
                                <label>Indoor Smoking</label>
                            </div>
                            <div class="input-div"> 
                                <input type="hidden" name="party" value="0">
                                <input type="checkbox" name="party" value=1 data-toggle="toggle" data-onstyle="success"
                                    data-offstyle="danger">
                                <label>Party</label>
                            </div>
                        </div>
                        <div class="input-text">
                            <div class="input-div">
                                <input type="hidden" name="pets" value="0">
                                <input type="checkbox" name="pets" value=1 data-toggle="toggle" data-onstyle="success"
                                    data-offstyle="danger">
                                <label>Pets</label>
                            </div>
                            <div class="input-div">
                                <input type="hidden" name="late_night_entry" value="0">
                                <input type="checkbox" name="late_night_entry" value=1 data-toggle="toggle" data-onstyle="success"
                                    data-offstyle="danger">
                                <label>Late Night Entry</label>
                            </div>
                        </div>
                        <div class="input-text">
                            <div class="input-div">
                                <input type="hidden" name="unknown_guest_entry" value="0">
                                <input type="checkbox" name="unknown_guest_entry" value=1 data-toggle="toggle" data-onstyle="success"
                                    data-offstyle="danger">
                                <label >Unknown Guest Entry</label>
                            </div>
                            
                        </div>
                        
                        
                    
                        <div class="buttons button_space">
                            <button class="back_button">Back</button>
                            <button class="next_button">Next Step</button>
                        </div>
                    </div>
                    
                    
                    
                    <div class="main">
                        <small><img src="{{asset('assets/img/logo/jayga-appicon1.png')}}" style="width: 50px; height: 50px;" alt="" srcset=""></small>
                        <div class="text">
                            <h2>Make it stand out</h2>
                            <p>Add some photos to your listing. You can add as many you want</p>
                        </div>
                        <div class="user_card">
                           <div class="input-text">
                            <input type="file" name="listingimages" multiple>
                           </div>
                        </div>
                        <div class="buttons button_space">
                            <button class="back_button">Back</button>
                            <button class="next_button">Next</button>
                        </div>
                    </div>
                    <div class="main">
                        <small><img src="{{asset('assets/img/logo/jayga-appicon1.png')}}" style="width: 50px; height: 50px;" alt="" srcset=""></small>
                        <div class="text">
                            <h2>Set your home address</h2>
                            <p>Set your home address and price for a day</p>
                        </div>
                        <div class="input-text">
                            <input type="text" name="street_address" placeholder="Street address">
                        </div>
                        <div class="input-text">
                            <input type="text" name="city" placeholder="City">
                        </div>
                        <div class="input-text">
                            <input type="text" name="town" placeholder="Town">
                        </div>
                        <div class="input-text">
                            <input type="text" name="zip" placeholder="Zip code">
                        </div>
                        <div class="input-text">
                            <input type="text" name="price" placeholder="Price for a day">
                        </div>
                        <div class="buttons button_space">
                            <button class="back_button">Back</button>
                            <button class="next_button">next</button>
                        </div>
                    </div>

                    <div class="main">
                        <small><img src="{{asset('assets/img/logo/jayga-appicon1.png')}}" style="width: 50px; height: 50px;" alt="" srcset=""></small>
                        <div class="text">
                            <h2>Please attach documents</h2>
                            <p>Upload your Nid and a copy of utility bill</p>
                        </div>
                        <div class="user_card">
                           <div class="input-text">
                            <input type="file" name="nid" multiple>
                           </div> <br>
                           <div class="input-text">
                            <input type="file" name="utility" multiple>
                           </div>
                        </div>
                        <div class="buttons button_space">
                            <button class="back_button">Back</button>
                            <button class="submit_button">Publish</button>
                        </div>
                    </div>
                     <div class="main">
                         <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                             <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
                            <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                        </svg>
                         
                        <div class="text congrats">
                            <h2>Congratulations!</h2>
                            <p>Thanks Mr./Mrs. <span class="shown_name"></span> your information have been submitted successfully for the future reference we will contact you soon.</p>
                        </div>
                    </div>
                     
                
                  
    
                
    
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>

        <script>
            var next_click = document.querySelectorAll(".next_button");
            var main_form = document.querySelectorAll(".main");
            var step_list = document.querySelectorAll(".progress-bar li");
            var num = document.querySelector(".step-number");
            let formnumber = 0;

            next_click.forEach(function (next_click_form) {
                next_click_form.addEventListener('click', function () {
                    if (!validateform()) {
                        return false
                    }
                    formnumber++;
                    updateform();
                    progress_forward();
                    contentchange();
                });
            });

            var back_click = document.querySelectorAll(".back_button");
            back_click.forEach(function (back_click_form) {
                back_click_form.addEventListener('click', function () {
                    formnumber--;
                    updateform();
                    progress_backward();
                    contentchange();
                });
            });

            var username = document.querySelector("#user_name");
            var shownname = document.querySelector(".shown_name");


            var submit_click = document.querySelectorAll(".submit_button");
            submit_click.forEach(function (submit_click_form) {
                submit_click_form.addEventListener('click', function () {
                    shownname.innerHTML = username.value;
                    formnumber++;
                    updateform();
                });
            });

            var heart = document.querySelector(".fa-heart");
            heart.addEventListener('click', function () {
                heart.classList.toggle('heart');
            });


            var share = document.querySelector(".fa-share-alt");
            share.addEventListener('click', function () {
                share.classList.toggle('share');
            });



            function updateform() {
                main_form.forEach(function (mainform_number) {
                    mainform_number.classList.remove('active');
                })
                main_form[formnumber].classList.add('active');
            }

            function progress_forward() {
                // step_list.forEach(list => {

                //     list.classList.remove('active');

                // }); 


                num.innerHTML = formnumber + 1;
                step_list[formnumber].classList.add('active');
            }

            function progress_backward() {
                var form_num = formnumber + 1;
                step_list[form_num].classList.remove('active');
                num.innerHTML = form_num;
            }

            var step_num_content = document.querySelectorAll(".step-number-content");

            function contentchange() {
                step_num_content.forEach(function (content) {
                    content.classList.remove('active');
                    content.classList.add('d-none');
                });
                step_num_content[formnumber].classList.add('active');
            }


            function validateform() {
                validate = true;
                var validate_inputs = document.querySelectorAll(".main.active input");
                validate_inputs.forEach(function (vaildate_input) {
                    vaildate_input.classList.remove('warning');
                    if (vaildate_input.hasAttribute('require')) {
                        if (vaildate_input.value.length == 0) {
                            validate = false;
                            vaildate_input.classList.add('warning');
                        }
                    }
                });
                return validate;

            }
        </script>
        <script>
            function incrementValue(e) {
                e.preventDefault();
                var fieldName = $(e.target).data('field');
                var parent = $(e.target).closest('div');
                var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

                if (!isNaN(currentVal)) {
                    parent.find('input[name=' + fieldName + ']').val(currentVal + 1);
                } else {
                    parent.find('input[name=' + fieldName + ']').val(0);
                }
            }

            function decrementValue(e) {
                e.preventDefault();
                var fieldName = $(e.target).data('field');
                var parent = $(e.target).closest('div');
                var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

                if (!isNaN(currentVal) && currentVal > 0) {
                    parent.find('input[name=' + fieldName + ']').val(currentVal - 1);
                } else {
                    parent.find('input[name=' + fieldName + ']').val(0);
                }
            }

            $('.input-group').on('click', '.button-plus', function (e) {
                incrementValue(e);
            });

            $('.input-group').on('click', '.button-minus', function (e) {
                decrementValue(e);
            });

        </script>
</body>
</html>