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
							<h3 class="page-title mt-3">Pending withdraw requests</h3>
							<ul class="breadcrumb">
								<li class="breadcrumb-item active">withdraw requests</li>
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
									<th>Phone</th>
									<th>Bank Name</th>
									<th>Account Name</th>
									<th>Account Number</th>
									<th>Routing Number</th>
									<th>Branch Name</th>
									<th>User Balance</th>
									<th>Withdraw Amount</th>
									<th>Status</th>
									<th>Mark as Paid</th>
									<th>Created At</th>
								</tr>
							</thead>
							<tbody>
								<?php $counter = 1; ?>
								@foreach ($withdraws as $item)
									<tr>
										<td>{{ $counter }}</td>
										<td>{{ $item->user_name }}</td>
										<td>{{ $item->phone }}</td>
										<td>{{ $item->bank_name }}</td>
										<td>{{ $item->acc_name }}</td>
										<td>{{ $item->acc_number }}</td>
										
										<td>{{$item->routing_num}}</td>
										
										<td>{{$item->branch_name}}</td>
										
		
										<td>{{ $item->user_balance }} tk/-</td>
		
										
                                        <td>{{$item->withdraw_amount}} tk/-</td>
		
										@if ($item->status == true)
											<td><span class="badge rounded-pill bg-success">Paid</span></td>
										@else
											<td><span class="badge rounded-pill bg-warning">Not Paid</span></td>
										@endif
										
										<td><a href="/admin/withdraw/confirm/{{$item->id}}" class="btn btn-success">Mark Paid</a></td>
										<td>{{$item->created_at->diffForHumans()}}</td>
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