@extends('admin.layouts')
@section('content')
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
		<table id="myTable" class="display ">
			<thead>
				<tr>
					<th>id</th>
					<th>Name on booking</th>
					<th>Listing Title</th>

					<th>phone</th>
					<th>Number of members</th>
					<th>Arrival Date</th>
					<th>Checkout Date</th>
					<th>Tier</th>
					<th>Booking Made</th>
					<th>Pay Amount</th>
					<th>Jayga_fee</th>
					<th>Net payable</th>
					<th>Booking_status</th>

					<th>Created At</th>

				</tr>
			</thead>
			<tbody>
				<?php $counter = 1; ?>
				@foreach ($pending as $item)
				<tr>
					<td>{{$counter}}</td>
					<td>{{ $item->booking_order_name }}</td>
					<td>{{ $item->listings->listing_title }}</td>

					<td>{{ $item->phone }}</td>
					<td>{{ $item->total_members }}</td>
					<td><span class="badge rounded-pill bg-success">{{ $item->date_enter }}</span></td>
					<td><span class="badge rounded-pill bg-danger">{{ $item->date_exit }}</span></td>

					@if ($item->tier == 0)
					<td><span class="badge rounded-pill bg-success">Full Stay</span></td>
					@else
					<td>{{ $item->tier }}</td>
					@endif

					<td>{{ $item->created_at->diffForHumans() }}</td>

					@if ($item->pay_amount == null)
					<td><span class="badge rounded-pill bg-warning">Not paid</span></td>
					@else
					<td>{{ $item->pay_amount }} tk/-</td>
					@endif

					<td>7%</td>

					<td>{{$item->pay_amount - ($item->pay_amount * 6.9)/100 }} tk/-</td>

					@if ($item->booking_status == 1)
					<td><span class="badge rounded-pill bg-success">Confirmed</span></td>
					@endif

					<td>{{$item->created_at->diffForHumans()}}</td>

				</tr>
				<?php $counter++; ?>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection