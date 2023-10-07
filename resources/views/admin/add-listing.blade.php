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
		<div class="header">
			<div class="header-left">
				<a href="index.php" class="logo"> <img src="assets/img/hotel_logo.png" width="50" height="70" alt="logo"> <span class="logoclass">Jayga Admin Panel</span> </a>
				<a href="index.php" class="logo logo-small"> <img src="assets/img/hotel_logo.png" alt="Logo" width="30" height="30"> </a>
			</div>
			<a href="javascript:void(0);" id="toggle_btn"> <i class="fe fe-text-align-left"></i> </a>
			<a class="mobile_btn" id="mobile_btn"> <i class="fas fa-bars"></i> </a>
			<ul class="nav user-menu">
				<li class="nav-item dropdown noti-dropdown">
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"> <i class="fe fe-bell"></i> <span class="badge badge-pill">3</span> </a>
					<!-- <div class="dropdown-menu notifications">
						<div class="topnav-dropdown-header"> <span class="notification-title">Notifications</span> <a href="javascript:void(0)" class="clear-noti"> Clear All </a> </div>
						<div class="noti-content">
							<ul class="notification-list">
								<li class="notification-message">
									<a href="#">
										<div class="media"> <span class="avatar avatar-sm">
											<img class="avatar-img rounded-circle" alt="User Image" src="assets/img/profiles/avatar-02.jpg">
											</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Carlson Tech</span> has approved <span class="noti-title">your estimate</span></p>
												<p class="noti-time"><span class="notification-time">4 mins ago</span> </p>
											</div>
										</div>
									</a>
								</li>
								<li class="notification-message">
									<a href="#">
										<div class="media"> <span class="avatar avatar-sm">
											<img class="avatar-img rounded-circle" alt="User Image" src="assets/img/profiles/avatar-11.jpg">
											</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">International Software
													Inc</span> has sent you a invoice in the amount of <span class="noti-title">$218</span></p>
												<p class="noti-time"><span class="notification-time">6 mins ago</span> </p>
											</div>
										</div>
									</a>
								</li>
								<li class="notification-message">
									<a href="#">
										<div class="media"> <span class="avatar avatar-sm">
											<img class="avatar-img rounded-circle" alt="User Image" src="assets/img/profiles/avatar-17.jpg">
											</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">John Hendry</span> sent a cancellation request <span class="noti-title">Apple iPhone
													XR</span></p>
												<p class="noti-time"><span class="notification-time">8 mins ago</span> </p>
											</div>
										</div>
									</a>
								</li>
								<li class="notification-message">
									<a href="#">
										<div class="media"> <span class="avatar avatar-sm">
											<img class="avatar-img rounded-circle" alt="User Image" src="assets/img/profiles/avatar-13.jpg">
											</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Mercury Software
													Inc</span> added a new product <span class="noti-title">Apple
													MacBook Pro</span></p>
												<p class="noti-time"><span class="notification-time">12 mins ago</span> </p>
											</div>
										</div>
									</a>
								</li>
							</ul>
						</div>
						<div class="topnav-dropdown-footer"> <a href="#">View all Notifications</a> </div>
					</div> -->
				</li>
				<li class="nav-item dropdown has-arrow">
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"> <span class="user-img"><img class="rounded-circle" src="assets/img/profiles/avatar-01.jpg" width="31" alt=""></span> </a>
					<div class="dropdown-menu">
						<div class="user-header">
							<div class="avatar avatar-sm"> <img src="assets/img/profiles/avatar-01.jpg" alt="User Image" class="avatar-img rounded-circle"> </div>
							<div class="user-text">
								<h6>Jayga Admin</h6>
								<p class="text-muted mb-0">Administrator</p>
							</div>
						</div> <a class="dropdown-item" href="profile.php">My Profile</a> <a class="dropdown-item" href="settings.php">Account Settings</a> <a class="dropdown-item" href="crud/logout.php">Logout</a> </div>
				</li>
			</ul>
		</div>
        <div class="sidebar" id="sidebar">
			<div class="sidebar-inner slimscroll">
				<div id="sidebar-menu" class="sidebar-menu">
					<ul>
						<li class="active"> <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a> </li>
						<li class="list-divider"></li>
						<li class="submenu"> <a href="#"><i class="fas fa-suitcase"></i> <span> Booking </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="all-booking.php"> All Booking </a></li>
								<li><a href="edit-booking.php"> Edit Booking </a></li>
								<li><a href="add-booking.php"> Add Booking </a></li>
							</ul>
						</li>
						<li class="submenu"> <a href="#"><i class="fas fa-user"></i> <span> Customers </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="all-user.php"> All Users </a></li>
								<li><a href="all-listing.php"> All Listing </a></li>
								<li><a href="edit-user.php"> Edit Users </a></li>
								<li><a href="edit-listing.php"> Edit Listing </a></li>
								<li><a href="add-user.php"> Add Users </a></li>
								<li><a href="/admin/add-listing"> Add Listing </a></li>
							</ul>
						</li>
						<li class="submenu"> <a href="#"><i class="fas fa-key"></i> <span> Stays </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="all-rooms.php">All Stays </a></li>
								<li><a href="edit-room.php"> Edit Stays </a></li>
								<li><a href="add-room.php"> Add Stays </a></li>
							</ul>
						</li>
						<!-- <li class="submenu"> <a href="#"><i class="fas fa-user"></i> <span> Staff </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="all-staff.php">All Staff </a></li>
								<li><a href="edit-staff.php"> Edit Staff </a></li>
								<li><a href="add-staff.php"> Add Staff </a></li>
							</ul>
						</li> -->
						<!-- <li> <a href="pricing.php"><i class="far fa-money-bill-alt"></i> <span>Pricing</span></a> </li>
						<li class="submenu"> <a href="#"><i class="fas fa-share-alt"></i> <span> Apps </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="chat.php"><i class="fas fa-comments"></i><span> Chat </span></a></li>
								<li class="submenu"> <a href="#"><i class="fas fa-video camera"></i> <span> Calls </span> <span class="menu-arrow"></span></a>
									<ul class="submenu_class" style="display: none;">
										<li><a href="voice-call.php"> Voice Call </a></li>
										<li><a href="video-call.php"> Video Call </a></li>
										<li><a href="incoming-call.php"> Incoming Call </a></li>
									</ul>
								</li>
								<li class="submenu"> <a href="#"><i class="fas fa-envelope"></i> <span> Email </span> <span class="menu-arrow"></span></a>
									<ul class="submenu_class" style="display: none;">
										<li><a href="compose.php">Compose Mail </a></li>
										<li><a href="inbox.php"> Inbox </a></li>
										<li><a href="mail-veiw.php"> Mail Veiw </a></li>
									</ul>
								</li>
							</ul>
						</li>
						<li class="submenu"> <a href="#"><i class="fas fa-user"></i> <span> Employees </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="employees.php">Employees List </a></li>
								<li><a href="leaves.php">Leaves </a></li>
								<li><a href="holidays.php">Holidays </a></li>
								<li><a href="attendance.php">Attendance </a></li>
							</ul>
						</li> -->
						<li class="submenu"> <a href="#"><i class="far fa-money-bill-alt"></i> <span> Accounts </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="invoices.php">Invoices </a></li>
								<li><a href="payments.php">Payments </a></li>
								<li><a href="expenses.php">Expenses </a></li>
								<li><a href="taxes.php">Taxes </a></li>
								<li><a href="provident-fund.php">Provident Fund </a></li>
							</ul>
						</li>
						<!-- <li class="submenu"> <a href="#"><i class="fas fa-book"></i> <span> Payroll </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="salary.php">Employee Salary </a></li>
								<li><a href="salary-veiw.php">Payslip </a></li>
							</ul>
						</li> -->
						<!-- <li> <a href="calendar.php"><i class="fas fa-calendar-alt"></i> <span>Calendar</span></a> </li> -->
						<!-- <li class="submenu"> <a href="#"><i class="fe fe-table"></i> <span> Blog </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="blog.php">Blog </a></li>
								<li><a href="blog-details.php">Blog Veiw </a></li>
								<li><a href="add-blog.php">Add Blog </a></li>
								<li><a href="edit-blog.php">Edit Blog </a></li>
							</ul>
						</li> -->
						<!-- <li> <a href="assets.php"><i class="fas fa-cube"></i> <span>Assests</span></a> </li> -->
						<li> <a href="activities.php"><i class="far fa-bell"></i> <span>Experiences</span></a> </li>
						<li class="submenu"> <a href="#"><i class="fe fe-table"></i> <span> Reports </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="expense-reports.php">Expense Report </a></li>
								<li><a href="invoice-reports.php">Invoice Report </a></li>
							</ul>
						</li>
						<li> <a href="settings.php"><i class="fas fa-cog"></i> <span>Settings</span></a> </li>
						<!-- <li class="list-divider"></li>
						<li class="menu-title mt-3"> <span>UI ELEMENTS</span> </li>
						<li class="submenu"> <a href="#"><i class="fas fa-laptop"></i> <span> Components </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="uikit.php">UI Kit </a></li>
								<li><a href="typography.php">Typography </a></li>
								<li><a href="tabs.php">Tabs </a></li>
							</ul>
						</li> -->
						<!-- <li class="submenu"> <a href="#"><i class="fas fa-edit"></i> <span> Forms </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="form-basic-inputs.php">Basic Input </a></li>
								<li><a href="form-input-groups.php">Input Groups </a></li>
								<li><a href="form-horizontal.php">Horizontal Form </a></li>
								<li><a href="form-vertical.php">Vertical Form </a></li>
							</ul>
						</li> -->
						<!-- <li class="submenu"> <a href="#"><i class="fas fa-table"></i> <span> Tables </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="tables-basic.php">Basic Table </a></li>
								<li><a href="tables-datatables.php">Data Table </a></li>
							</ul>
						</li>
						<li class="list-divider"></li>
						<li class="menu-title mt-3"> <span>EXTRAS</span> </li> -->
						<!-- <li class="submenu"> <a href="#"><i class="fas fa-columns"></i> <span> Pages </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="login.php">Login </a></li>
								<li><a href="register.php">Register </a></li>
								<li><a href="forgot-password.php">Forgot Password </a></li>
								<li><a href="change-password.php">Change Password </a></li>
								<li><a href="lock-screen.php">Lockscreen </a></li>
								<li><a href="profile.php">Profile </a></li>
								<li><a href="gallery.php">Gallery </a></li>
								<li><a href="error-404.php">404 Error </a></li>
								<li><a href="error-500.php">500 Error </a></li>
								<li><a href="blank-page.php">Blank Page </a></li>
							</ul>
						</li> -->
						<!-- <li class="submenu"> <a href="#"><i class="fas fa-share-alt"></i> <span> Multi Level </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="">Level 1 </a></li>
								<li><a href="">Level 2 </a></li>
							</ul>
						</li> -->
					</ul>
				</div>
			</div>
		</div>
	
		<div class="page-wrapper">
			<div class="content container-fluid">
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col">
							<h3 class="page-title mt-5">Add Listing</h3> </div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
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
											@else
												<option value="none ">No User found</option>
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
										<input class="form-control" name="bedroom_num" type="number">
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
										<textarea class="form-control" rows="5" name="describe_listing"></textarea>
									</div>
								</div>
						
								<div class="col-md-4">
									<div class="form-group">
										<label>What is the price set for a day stay?</label>
										<input class="form-control" name="price" type="number">
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
										<input type="hidden" name="peaceful" value="0" >
										<input type="checkbox" name="peaceful" value=1 data-toggle="toggle"
											data-onstyle="success" data-offstyle="danger">
									</div>
								</div>
						
								<div class="col-md-4">
									<div class="form-group">
										<label>Is it unique?</label>
										<br>
										<input type="hidden" name="unique" value="0" >
										<input type="checkbox" name="unique" value=1 checked data-toggle="toggle"
											data-onstyle="success" data-offstyle="danger">
									</div>
								</div>
						
								<div class="col-md-4">
									<div class="form-group">
										<label>Is it family friendly?</label>
										<br>
										<input type="hidden" name="family_friendly" value="0" >
										<input type="checkbox" name="family_friendly" value=1 checked data-toggle="toggle"
											data-onstyle="success" data-offstyle="danger">
									</div>
								</div>
						
								<div class="col-md-4">
									<div class="form-group">
										<label>Is it stylish?</label>
										<br>
										<input type="hidden" name="stylish" value="0" >
										<input type="checkbox" name="stylish" value=1 checked data-toggle="toggle"
											data-onstyle="success" data-offstyle="danger">
									</div>
								</div>
						
								<div class="col-md-4">
									<div class="form-group">
										<label>Is it central?</label>
										<br>
										<input type="hidden" name="central" value="0" >
										<input type="checkbox" name="central" value=1 checked data-toggle="toggle"
											data-onstyle="success" data-offstyle="danger">
									</div>
								</div>
						
								<div class="col-md-4">
									<div class="form-group">
										<label>Is it spacious?</label>
										<br>
										<input type="hidden" name="spacious" value="0" >
										<input type="checkbox" name="spacious" value=1  data-toggle="toggle"
											data-onstyle="success" data-offstyle="danger">
									</div>
								</div>
						
						
						
								<div class="col-md-4">
									<div class="form-group">
										<label>Does it have a private bathroom?</label>
										<br>
										<input type="hidden" name="private_bathroom" value="0" >
										<input type="checkbox" name="private_bathroom" value=1  data-toggle="toggle"
											data-onstyle="success" data-offstyle="danger">
									</div>
								</div>
						
								<div class="col-md-4">
									<div class="form-group">
										<label>Is breakfast available?</label>
										<br>
										<input type="hidden" name="breakfast_included" value="0" >
										<input type="checkbox" name="breakfast_included" value=1 data-toggle="toggle"
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
										<label>Will there be anyone else in the house?</label>
										<input type="hidden" name="unknown_guest_entry" value="0" >
										<br><input type="checkbox" name="unknown_guest_entry" value=1  data-toggle="toggle"
											data-onstyle="success" data-offstyle="danger">
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