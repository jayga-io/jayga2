<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>Jayga Admin - Create Listing</title>
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
	<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/feathericon.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/plugins/morris/morris.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
	<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
	@livewireStyles
 </head>

<body>
	<div class="main-wrapper">
		
        @include('admin.sidebar')
	
		<div class="page-wrapper">
			<div class="content container-fluid">
				
				<div class="page-header">
					
					<div class="row align-items-center">
						
						<div class="col">
							
							<h3 class="page-title mt-5">Add Listing</h3> 
						</div>
					</div>
				</div>
				<div class="row">
				<div class="col-lg-12">
					@if(session()->has('success'))
					
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong>{{ session()->get('success') }}</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					
					
					@endif
					
					@if (session()->has('deleted'))
					
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>{{ session()->get('deleted') }}</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					
					@endif
					
					@if (session()->has('errors'))
					<div class="alert alert-danger">
						<ul>
					
							<li>{{ $errors }}</li>
					
						</ul>
					</div>
					@endif
						<form action="{{ route('create_listing') }}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="row formtype">
						
								<div class="col-md-4">
									<div class="form-group">
										<label>Lister ID and Name</label>
										<select class="form-control" selected id="lister_id" name="lister_id" >
											<option value="none" selected disabled hidden>Select an Option</option> 
											
											@if (count($users)>0)
												@foreach ($users as $item)
													<option value="{{$item->id}}, {{$item->name}}" >{{$item->name}}</option>
												@endforeach
											
											@endif
											
						
										</select>
									</div>
								</div>
						
								<!-- Hidden input fields to store the selected lister_id and lister_name -->
								<input type="hidden" id="selected_lister_id" name="lister_id" value="">
								<input type="hidden" id="selected_lister_name" name="selected_lister_name" value="">
						
						
						
						
								<div class="col-md-4">
									<div class="form-group">
										<label>Guest Number Allowed</label>
										<input class="form-control" name="guest_num" type="number">
									</div>
								</div>
						
						
								<div class="col-md-4">
									<div class="form-group">
										<label>How many Bedrooms?</label>
										<input class="form-control" name="bed_num" type="number">
									</div>
								</div>
						
								<div class="col-md-4">
									<div class="form-group">
										<label>How many Bathrooms?</label>
										<input class="form-control" name="bathroom_num" type="number">
									</div>
								</div>
						
								<div class="col-md-4">
									<div class="form-group">
										<label>Give your Listing a title</label>
										<input class="form-control" name="listing_title" type="text">
									</div>
								</div>
						
								<div class="col-md-4">
									<div class="form-group">
										<label>Describe Listing?</label>
										<!-- <input class="form-control" name="name" type="text" >  -->
										<textarea class="form-control" rows="5" name="listing_description"></textarea>
									</div>
								</div>
						
								<div class="col-md-4">
									<div class="form-group">
										<label>What is the price set for a day stay?</label>
										<input class="form-control" name="full_day_price_set_by_user" type="number">
									</div>
								</div>
						
								<!-- <div class="col-md-4">
															<div class="form-group">
																<label>What is the price for short stay?</label>
																<input class="form-control" name="name" type="text" > </div>
														</div> -->
						
								<div class="col-md-4">
									<div class="form-group">
										<label>What is the listing adress?</label>
										<input class="form-control" name="listing_address" type="text">
									</div>
								</div>
						
								<div class="col-md-4">
									<div class="form-group">
										<label>Listing zip code?</label>
										<input class="form-control" name="zip_code" type="text">
									</div>
								</div>
						
								<div class="col-md-4">
									<div class="form-group">
										<label>Which district is it in?</label>
										<input class="form-control" name="district" type="text">
									</div>
								</div>
						
								<div class="col-md-4">
									<div class="form-group">
										<label>Which town is it in?</label>
										<input class="form-control" name="town" type="text">
									</div>
								</div>
						
						
						
								<div class="col-md-4">
									<div class="form-group">
										<label>Would you allow short stay?</label>
										<br>
										<input type="hidden" name="allow_short_stay"  value="0">
										<input type="checkbox" name="allow_short_stay" value="1" data-toggle="toggle"
											data-onstyle="success" data-offstyle="danger">
									</div>
								</div>
						
								<div class="col-md-4">
									<div class="form-group">
										<label>Is it peaceful?</label>
										<br>
										<input type="hidden" name="describe_peaceful" value="0" >
										<input type="checkbox" name="describe_peaceful" value=1 data-toggle="toggle"
											data-onstyle="success" data-offstyle="danger">
									</div>
								</div>
						
								<div class="col-md-4">
									<div class="form-group">
										<label>Is it unique?</label>
										<br>
										<input type="hidden" name="describe_unique" value="0" >
										<input type="checkbox" name="describe_unique" value=1 checked data-toggle="toggle"
											data-onstyle="success" data-offstyle="danger">
									</div>
								</div>
						
								<div class="col-md-4">
									<div class="form-group">
										<label>Is it family friendly?</label>
										<br>
										<input type="hidden" name="describe_familyfriendly" value="0" >
										<input type="checkbox" name="describe_familyfriendly" value=1 checked data-toggle="toggle"
											data-onstyle="success" data-offstyle="danger">
									</div>
								</div>
						
								<div class="col-md-4">
									<div class="form-group">
										<label>Is it stylish?</label>
										<br>
										<input type="hidden" name="describe_stylish" value="0" >
										<input type="checkbox" name="describe_stylish" value=1 checked data-toggle="toggle"
											data-onstyle="success" data-offstyle="danger">
									</div>
								</div>
						
								<div class="col-md-4">
									<div class="form-group">
										<label>Is it central?</label>
										<br>
										<input type="hidden" name="describe_central" value="0" >
										<input type="checkbox" name="describe_central" value=1 checked data-toggle="toggle"
											data-onstyle="success" data-offstyle="danger">
									</div>
								</div>
						
								<div class="col-md-4">
									<div class="form-group">
										<label>Is it spacious?</label>
										<br>
										<input type="hidden" name="describe_spacious" value="0" >
										<input type="checkbox" name="describe_spacious" value=1  data-toggle="toggle"
											data-onstyle="success" data-offstyle="danger">
									</div>
								</div>
						
						
						
								
						
								<div class="col-md-4">
									<div class="form-group">
										<label>Is room lock available?</label>
										<br>
										<input type="hidden" name="door_lock" value="0" >
										<input type="checkbox" name="door_lock" value=1 data-toggle="toggle" data-onstyle="success"
											data-offstyle="danger">
									</div>
								</div>
						
								
						
								<div class="col-md-4">
									<div class="form-group">
										<label>Listing Type</label>
										<select class="form-control" name="listing_type">
											<option>Select</option>
											<option>Room</option>
											<option>Appartment</option>
											<option>Hotel</option>
											<!-- <option>King</option>
												<option>Suite</option>
												<option>Villa</option> -->
										</select>
						
									</div>
								</div>
						
								<div class="col-md-4">
									<div class="form-group">
										<label> Upload Listing Pictures</label>
										<div class="custom-file mb-3">
											<!-- <input type="file" class="custom-file-input" name="user_pic[]" multiple onchange="displayFileNames(event)">
																		  <div id="file-names"></div> -->
											<input type="file" name="listing_pictures[]" class="form-control input-lg" multiple>
											<!-- <label class="custom-file-label" for="customFile">Choose file</label> -->
										</div>
									</div>
								</div>
						
							</div>
							<div class="row formtype">
								<div class="accordion" style="width: 100%" id="accordionExample">
									<div class="card">
									  <div class="card-header" id="headingOne">
										<h2 class="mb-0">
										  <button class="btn btn-primary btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
											Amenities
										  </button>
										</h2>
									  </div>
								  
									  <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
										<div class="card-body">
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>Wifi</label>
														<br>
														<input type="hidden" name="wifi" value="0">
														<input type="checkbox" name="wifi" value=1 data-toggle="toggle" data-onstyle="success"
															data-offstyle="danger">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>TV</label>
														<br>
														<input type="hidden" name="tv" value="0">
														<input type="checkbox" name="tv" value=1 data-toggle="toggle" data-onstyle="success"
															data-offstyle="danger">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Kitchen</label>
														<br>
														<input type="hidden" name="kitchen" value="0">
														<input type="checkbox" name="kitchen" value=1 data-toggle="toggle" data-onstyle="success"
															data-offstyle="danger">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Washing Machine</label>
														<br>
														<input type="hidden" name="washing_machine" value="0">
														<input type="checkbox" name="washing_machine" value=1 data-toggle="toggle" data-onstyle="success"
															data-offstyle="danger">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Free Parking</label>
														<br>
														<input type="hidden" name="free_parking" value="0">
														<input type="checkbox" name="free_parking" value=1 data-toggle="toggle" data-onstyle="success"
															data-offstyle="danger">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Breakfast Included</label>
														<br>
														<input type="hidden" name="breakfast_included" value="0">
														<input type="checkbox" name="breakfast_included" value=1 data-toggle="toggle" data-onstyle="success"
															data-offstyle="danger">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Air Condition</label>
														<br>
														<input type="hidden" name="air_condition" value="0">
														<input type="checkbox" name="air_condition" value=1 data-toggle="toggle" data-onstyle="success"
															data-offstyle="danger">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Dedicated Workspace</label>
														<br>
														<input type="hidden" name="dedicated_workspace" value="0">
														<input type="checkbox" name="dedicated_workspace" value=1 data-toggle="toggle" data-onstyle="success"
															data-offstyle="danger">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Pool</label>
														<br>
														<input type="hidden" name="pool" value="0">
														<input type="checkbox" name="pool" value=1 data-toggle="toggle" data-onstyle="success"
															data-offstyle="danger">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Hot Tub</label>
														<br>
														<input type="hidden" name="hot_tub" value="0">
														<input type="checkbox" name="hot_tub" value=1 data-toggle="toggle" data-onstyle="success"
															data-offstyle="danger">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Patio</label>
														<br>
														<input type="hidden" name="patio" value="0">
														<input type="checkbox" name="patio" value=1 data-toggle="toggle" data-onstyle="success"
															data-offstyle="danger">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>BBQ Grill</label>
														<br>
														<input type="hidden" name="bbq_grill" value="0">
														<input type="checkbox" name="bbq_grill" value=1 data-toggle="toggle" data-onstyle="success"
															data-offstyle="danger">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Outdooring</label>
														<br>
														<input type="hidden" name="outdooring" value="0">
														<input type="checkbox" name="outdooring" value=1 data-toggle="toggle" data-onstyle="success"
															data-offstyle="danger">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Fire Pit</label>
														<br>
														<input type="hidden" name="fire_pit" value="0">
														<input type="checkbox" name="fire_pit" value=1 data-toggle="toggle" data-onstyle="success"
															data-offstyle="danger">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Gym</label>
														<br>
														<input type="hidden" name="gym" value="0">
														<input type="checkbox" name="gym" value=1 data-toggle="toggle" data-onstyle="success"
															data-offstyle="danger">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Beach Lake Access</label>
														<br>
														<input type="hidden" name="beach_lake_access" value="0">
														<input type="checkbox" name="beach_lake_access" value=1 data-toggle="toggle" data-onstyle="success"
															data-offstyle="danger">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Smoke Alarm</label>
														<br>
														<input type="hidden" name="smoke_alarm" value="0">
														<input type="checkbox" name="smoke_alarm" value=1 data-toggle="toggle" data-onstyle="success"
															data-offstyle="danger">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>First Aid</label>
														<br>
														<input type="hidden" name="first_aid" value="0">
														<input type="checkbox" name="first_aid" value=1 data-toggle="toggle" data-onstyle="success"
															data-offstyle="danger">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Fire Ext</label>
														<br>
														<input type="hidden" name="fire_extinguish" value="0">
														<input type="checkbox" name="fire_extinguish" value=1 data-toggle="toggle" data-onstyle="success"
															data-offstyle="danger">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>CCTV</label>
														<br>
														<input type="hidden" name="cctv" value="0">
														<input type="checkbox" name="cctv" value=1 data-toggle="toggle" data-onstyle="success"
															data-offstyle="danger">
													</div>
												</div>
												
											</div>
											
										</div>
									  </div>
									</div>
									<div class="card">
									  <div class="card-header" id="headingTwo">
										<h2 class="mb-0">
										  <button class="btn btn-primary btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
											Describes
										  </button>
										</h2>
									  </div>
									  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
										<div class="card-body">
										  <div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>Apartment</label>
													<br>
													<input type="hidden" name="apartments" value="0">
													<input type="checkbox" name="apartments" value=1 data-toggle="toggle" data-onstyle="success"
														data-offstyle="danger">
												</div>
											</div><div class="col-md-4">
												<div class="form-group">
													<label>Cabin</label>
													<br>
													<input type="hidden" name="cabin" value="0">
													<input type="checkbox" name="cabin" value=1 data-toggle="toggle" data-onstyle="success"
														data-offstyle="danger">
												</div>
											</div><div class="col-md-4">
												<div class="form-group">
													<label>Lounge</label>
													<br>
													<input type="hidden" name="lounge" value="0">
													<input type="checkbox" name="lounge" value=1 data-toggle="toggle" data-onstyle="success"
														data-offstyle="danger">
												</div>
											</div><div class="col-md-4">
												<div class="form-group">
													<label>Farm</label>
													<br>
													<input type="hidden" name="farm" value="0">
													<input type="checkbox" name="farm" value=1 data-toggle="toggle" data-onstyle="success"
														data-offstyle="danger">
												</div>
											</div><div class="col-md-4">
												<div class="form-group">
													<label>Campsite</label>
													<br>
													<input type="hidden" name="campsite" value="0">
													<input type="checkbox" name="campsite" value=1 data-toggle="toggle" data-onstyle="success"
														data-offstyle="danger">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Hotel</label>
													<br>
													<input type="hidden" name="hotel" value="0">
													<input type="checkbox" name="hotel" value=1 data-toggle="toggle" data-onstyle="success"
														data-offstyle="danger">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Bread Breakfast</label>
													<br>
													<input type="hidden" name="bread_breakfast" value="0">
													<input type="checkbox" name="bread_breakfast" value=1 data-toggle="toggle" data-onstyle="success"
														data-offstyle="danger">
												</div>
											</div>
										  </div>
										</div>
									  </div>
									</div>
									<div class="card">
									  <div class="card-header" id="headingThree">
										<h2 class="mb-0">
										  <button class="btn btn-primary btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
											Restrictions
										  </button>
										</h2>
									  </div>
									  <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
										<div class="card-body">
										  <div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>Indoor Smoking</label>
													<br>
													<input type="hidden" name="indoor_smoking" value="0">
													<input type="checkbox" name="indoor_smoking" value=1 data-toggle="toggle" data-onstyle="success"
														data-offstyle="danger">
												</div>
											</div><div class="col-md-4">
												<div class="form-group">
													<label>Party</label>
													<br>
													<input type="hidden" name="party" value="0">
													<input type="checkbox" name="party" value=1 data-toggle="toggle" data-onstyle="success"
														data-offstyle="danger">
												</div>
											</div><div class="col-md-4">
												<div class="form-group">
													<label>Pets</label>
													<br>
													<input type="hidden" name="pets" value="0">
													<input type="checkbox" name="pets" value=1 data-toggle="toggle" data-onstyle="success"
														data-offstyle="danger">
												</div>
											</div><div class="col-md-4">
												<div class="form-group">
													<label>Late Night Entry</label>
													<br>
													<input type="hidden" name="late_night_entry" value="0">
													<input type="checkbox" name="late_night_entry" value=1 data-toggle="toggle" data-onstyle="success"
														data-offstyle="danger">
												</div>
											</div><div class="col-md-4">
												<div class="form-group">
													<label>Unknown Guest Entry</label>
													<br>
													<input type="hidden" name="unknown_guest_entry" value="0">
													<input type="checkbox" name="unknown_guest_entry" value=1 data-toggle="toggle" data-onstyle="success"
														data-offstyle="danger">
												</div>
											</div><div class="col-md-4">
												<div class="form-group">
													<label>Specific Requirement</label>
													<br>
													<input type="hidden" name="specific_requirement" value="0">
													<input type="checkbox" name="specific_requirement" value=1 data-toggle="toggle" data-onstyle="success"
														data-offstyle="danger">
												</div>
											</div>
										  </div>
										</div>
									  </div>
									</div>
								  </div>
							</div>
							<button type="submit" class="btn btn-primary buttonedit1">Create Listing</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="{{asset('assets/js/jquery-3.5.1.min.js')}}"></script>
	<script src="{{asset('assets/js/popper.min.js')}}"></script>
	<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
	<script src="{{asset('assets/plugins/raphael/raphael.min.js')}}"></script>
	<script src="{{asset('assets/js/moment.min.js')}}"></script>
	<script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script>
	<script src="{{asset('assets/js/script.js')}}"></script>
	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
	<script>
	document.getElementById("lister_id").addEventListener("change", function() {
		var selectElement = this;
		var selectedOption = selectElement.options[selectElement.selectedIndex];
		var selectedListerID = selectedOption.value;
		var selectedListerName = selectedOption.getAttribute("data-name");

		// Update the hidden input fields with the selected lister_id and lister_name
		document.getElementById("selected_lister_id").value = selectedListerID;
		document.getElementById("selected_lister_name").value = selectedListerName;

		// You can also display the selected lister name somewhere if needed
		// For example, in a <span> element with id="selected_lister_name_display"
		// document.getElementById("selected_lister_name_display").textContent = selectedListerName;
	});
	</script>


	<script>
	$(function() {
		$('#datetimepicker3').datetimepicker({
			format: 'LT'
		});
	});
	</script>
	@livewireScripts
</body>

</html>