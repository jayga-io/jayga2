@extends('admin.layouts')
@section('content')
    <div>
        

        <div class="container my-5">
            <h1 class="mb-4">All Reports</h1>
            <table id="myTable" class="display">
				<thead>
					<tr>
						<th>id</th>
						<th>listing id</th>
                        <th>listing title</th>
                        <th>lister</th>
                        <th>user</th>
                        <th>comments</th>
						<th>delete</th>
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