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
						<div class="col-md-6">
							<h3 class="page-title mt-5">Add Booking</h3> 
                        </div>
                       
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<form action="{{ route('createbooking') }}" method="POST" enctype="multipart/form-data">
                            @csrf
							<div class="row formtype">
                                <div class="col-md-12 mb-3">
                                    <label for="short_stay" >Use Short Stay</label>
                                    <input type="hidden" name="short_stay"  value="0">
                                    <input type="checkbox" name="short_stay" value="1" data-toggle="toggle" id="fieldA" data-onstyle="success" data-offstyle="danger">
                                </div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Name of the booking</label>
										<input class="form-control" type="text" name="booking_order_name" placeholder="Enter bookie name"> 
                                    </div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Select User</label>
										<select class="form-control" id="sel1" name="user">
											<option>Select</option>
                                            @foreach ($user as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
											
											
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Select Listing</label>
										<select class="form-control" id="sel1" name="listing">
											<option>Select</option>
                                            @foreach ($listing as $item)
                                                <option value="{{ $item->listing_id }}">{{ $item->listing_title }}</option>
                                            @endforeach
											
											
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Listing Type</label>
										<select class="form-control" id="sel2" name="listing_type">
											<option>Select</option>
											<option>Cabin</option>
											<option>Lounge</option>
											<option>Hotel</option>
											<option>Apartment</option>
											<option>Room</option>
											<option>Villa</option>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Total Members</label>
										<input type="number" class="form-control" name="members" placeholder="Enter guest number">
									</div>
								</div>
								
								<div class="col-md-4">
									<div class="form-group">
										<label>Arrival Date</label>
										<div class="cal-icon">
											<input type="text" name="date_enter" class="form-control datetimepicker"> 
                                        </div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Checkout Date</label>
										<div class="cal-icon">
											<input type="text" name="date_exit" id="fieldB" class="form-control datetimepicker"> </div>
									</div>
								</div>

                               
								<div class="col-md-4">
									<div class="form-group">
										<label>Time</label>
										<select class="form-control" id="fieldC" name="tier" disabled>
											<option>Select</option>
                                            @foreach ($times as $item)
                                                <option value="{{ $item->time_id }}">{{ $item->times }}</option>
                                            @endforeach
											
											
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Email ID</label>
										<input type="text" name="email" class="form-control" id="usr"> 
                                    </div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Guest Phone Number</label>
										<input type="text" name="phone" class="form-control" id="usr1"> </div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Upload Guest Nid</label>
										<div class="custom-file mb-3">
											<input type="file" class="custom-file-input" id="customFile" name="guest_nid" multiple>
											<label class="custom-file-label" for="customFile">Choose file</label>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Message</label>
										<textarea class="form-control" rows="5" id="comment" name="messege"></textarea>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
				<button type="button" class="btn btn-primary buttonedit1">Create Booking</button>
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
	$(function() {
		$('#datetimepicker3').datetimepicker({
			format: 'LT'
		});
	});
	</script>

    <script>
       $("#fieldA").change(function() {
            if ($("#fieldC").attr('disabled')) {
                $("#fieldC").removeAttr('disabled');
                $("#fieldB").attr('disabled', 'disabled');
                
            } else {
                $('#fieldB').removeAttr('disabled');
                $('#fieldC').attr('disabled', 'disabled');
            }
        });
    </script>
</body>

</html>