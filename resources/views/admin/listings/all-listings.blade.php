<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>Jaygaa Dashboard | All Listings</title>
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
	<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/feathericon.min.css')}}">
	<link rel="stylehseet" href="https://cdn.oesmith.co.uk/morris-0.5.1.css">
	<link rel="stylesheet" href="{{asset('assets/plugins/morris/morris.css')}}">
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
	<script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
	<link rel="stylesheet" href="{{asset('assets/css/style.css')}}"> 
	
	
</head>

<body>
	<div class="main-wrapper">
		

        @include('admin.sidebar');
		<div class="page-wrapper">
			<div class="container-fluid">
				<div class="page-header">
					<div class="row">
						<div class="col-sm-12 mt-5">
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
							<h3 class="page-title mt-3">All Listings</h3>
							<ul class="breadcrumb">
								<li class="breadcrumb-item active">Manage all available listings <strong>(Sorted by most recent)</strong></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<table id="myTable" class="display">
							<thead>
								<tr>
									<th>id</th>
									<th>Lister Name</th>
									<th>Listing Title</th>
									<th>Number of guest allowed</th>
									<th>Full Day Price</th>
									<th>Listing Address</th>
									<th>Short Stay Allow</th>
									<th>Listing Type</th>
									<th>Approval Status</th>
									<th>Active Status</th>
									<th>View</th>
									
									<th>Delete</th>
								</tr>
							</thead>
							<tbody>
								<?php $counter = 1; ?>
								@foreach ($all as $item)
									<tr>
										<td>{{ $counter }}</td>
										<td>{{ $item->lister_name }}</td>
										<td>{{ $item->listing_title }}</td>
										<td>{{ $item->guest_num }}</td>
										<td>{{ $item->full_day_price_set_by_user }} tk/-</td>
										<td>{{ $item->listing_address }}</td>
										@if ($item->allow_short_stay == true)
											<td><span class="badge rounded-pill bg-success" >Allowed</span></td>
										@else
											<td><span class="badge rounded-pill bg-danger" >Not Allowed</span></td>
										@endif
		
										<td>{{ $item->listing_type }}</td>
		
										@if ($item->isApproved == true)
											<td><span class="badge rounded-pill bg-success" >Approved</span></td>
										@else
											<td><span class="badge rounded-pill bg-warning" >Not Approved</span></td>
										@endif
		
										@if ($item->isActive == true)
											<td><span class="badge rounded-pill bg-success">Active</span></td>
										@else
											<td><span class="badge rounded-pill bg-secondary">Inactive</span></td>
										@endif
										<td><a href="/admin/view-listing/{{$item->listing_id}}" class="btn btn-warning"><i class="fa fa-eye"></i></a></td>
										
										<td><a href="/admin/delete-listing/{{$item->listing_id}}" class="btn btn-warning">Delete</a></td>
									</tr>
									<?php $counter++; ?>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			
			</div>
		</div>
		
	</div>
	
	
    <script>
        let table = new DataTable('#myTable',{
            scrollX: true
        });
    </script>
	<script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
	
	<script src="{{asset('assets/js/popper.min.js')}}"></script>
	<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
	<script src="{{asset('assets/plugins/raphael/raphael.min.js')}}"></script>
	<script src="{{asset('assets/plugins/morris/morris.min.js')}}"></script>
	<script src="{{asset('assets/js/chart.morris.js')}}"></script>
	<script src="{{asset('assets/js/script.js')}}"></script>
	
</body>