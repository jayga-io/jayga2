@extends('admin.layouts')
@section('content')
    <div>
        

        <div class="container my-5">
            <h1 class="mb-4">All Reports</h1>
            <table id="myTable" class="display">
				<thead>
					<tr>
						<th>id</th>
						<th>Listing id</th>
                        <th>Listing title</th>
                        <th>Lister</th>
                        <th>From User</th>
						<th>Report Type</th>
                        <th>Comments</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>
					<?php $counter = 1; ?>
					@foreach ($reports as $item)
						<tr>
							<td>{{ $counter }}</td>
							<td>{{$item->listing_id}}</td>
							<td>{{$item->listing->listing_title}}</td>
                            <td>{{$item->lister->name}}</td>
                            <td>{{$item->user->name}}</td>
							<td>{{$item->report_category->category_name}}</td>
                            <td>{{$item->comments}}</td>
                            <td>Delete</td>
						</tr>
						<?php $counter++; ?>
					@endforeach
				</tbody>
			</table>
           
        </div>

  
</div>
    
@endsection