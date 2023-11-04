<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>Jaygaa Dashboard</title>
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
	<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/feathericon.min.css')}}">
	<link rel="stylehseet" href="https://cdn.oesmith.co.uk/morris-0.5.1.css">
	<link rel="stylesheet" href="{{asset('assets/plugins/morris/morris.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/style.css')}}"> 
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
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
							<h3 class="page-title mt-3">Pending Bookings</h3>
							<ul class="breadcrumb">
								<li class="breadcrumb-item active">Approve Bookings</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<table id="myTable" class="display">
								<thead>
									<tr>
										<th>Name on booking</th>
										<th>email</th>
										<th>phone</th>
										<th>Number of members</th>
										<th>Arrival Date</th>
										<th>View Details</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($pending as $item)
										<tr>
											<td>{{$item->booking_order_name }}</td>
											<td>{{$item->email}}</td>
											<td>{{$item->phone }}</td>
											<td>{{$item->total_members }}</td>
                                            <td>{{$item->date_enter}}</td>
											<td><a class="btn btn-primary" href="/admin/view-booking/{{$item->booking_id}}">View Bookings</a></td>
											<td> <a class="btn btn-primary" href="/admin/approve-booking/{{$item->booking_id}}">Approve</a> | <a class="btn btn-danger" href="/admin/decline-booking/{{$item->listing_id}}">Decline</a></td>
										</tr>
									@endforeach
									
									
								</tbody>
							</table>
					</div>
				</div>
			
		</div>
		</div>
		
	</div>
	<script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
	<script>
		let table = new DataTable('#myTable');
	</script>
	<script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
	<script src="{{asset('assets/js/jquery-3.5.1.min.js')}}"></script>
	<script src="{{asset('assets/js/popper.min.js')}}"></script>
	<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
	<script src="{{asset('assets/plugins/raphael/raphael.min.js')}}"></script>
	<script src="{{asset('assets/plugins/morris/morris.min.js')}}"></script>
	<script src="{{asset('assets/js/chart.morris.js')}}"></script>
	<script src="{{asset('assets/js/script.js')}}"></script>
</body>