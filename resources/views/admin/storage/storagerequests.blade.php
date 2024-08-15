@extends('admin.layouts')
@section('content')
    <div class="my-5">
        <h1>Storage Requests</h1>
        

        <div class="row my-3 mx-auto">
            <table id="myTable" class="display">
				<thead>
					<tr>
						<th>id</th>
                        <th>Inventory Item</th>
						<th>Inventory Type</th>
						<th>User</th>
                        <th>Quantity</th>
                        <th>Address</th>
                        <th>Store Status</th>
                        <th>Created at</th>
                        <th>View</th>
                        
						<th>Delete</th>
                        
					</tr>
				</thead>
				<tbody>
					<?php $counter = 1; ?>
                    @foreach ($inventories as $item)
                        <tr>
                            <td>{{$counter}}</td>
                            <td>{{$item->item_name}}</td>
                            <td>{{$item->item_type}}</td>
                            <td>{{$item->user->name}}</td>
                            <td>{{$item->quantity_value}}.{{$item->quantity_type}}</td>
                            <td>{{$item->business_location->district}},{{$item->business_location->primary_address}}</td>
                            @if ($item->status == true)
                                <td><span>&#128994; In store</span></td>
                            @else
                                <td><span>&#128308; Not in store</span></td>
                            @endif
                            <td>{{$item->created_at->diffForHumans()}}</td>
                            <td><a href="#" class="btn btn-primary">View</a></td>
                            
                            <td><a href="#" class="btn btn-danger">Delete</a></td>
                        </tr>
                        <?php $counter++; ?>
                    @endforeach
				</tbody>
			</table>
        </div>
    </div>
@endsection