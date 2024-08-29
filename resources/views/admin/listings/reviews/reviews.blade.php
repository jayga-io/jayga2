@extends('admin.layouts')
@section('content')
    <div>
        

        <div class="container my-5">
            <h1 class="mb-4">All Reviews</h1>
            <table id="myTable" class="display">
				<thead>
					<tr>
						<th>id</th>
						<th>User</th>
                        <th>Listing title</th>
                        
                        <th>Stars</th>
						<th>Description</th>
                        <th>Posted at</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>
					<?php $counter = 1; ?>
					@foreach ($reviews as $item)
						<tr>
							<td>{{ $counter }}</td>
							<td>{{$item->user->name}}</td>
							<td>{{$item->listing->listing_title}}</td>
							
							<td>{{$item->stars}}</td>
							<td>{{$item->description}}</td>
							<td>{{$item->created_at->diffForHumans()}}</td>
							
                            <td><a href="/admin/delete/listing-review/{{$item->review_id}}" class="btn btn-danger">Delete</a></td>
						</tr>
						<?php $counter++; ?>
					@endforeach
				</tbody>
			</table>
           
        </div>

  
</div>
    
@endsection