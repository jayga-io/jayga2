@extends('admin.layouts')
@section('content')
    <div>
        <div class="container my-5">
            <h1>Restrictions</h1>
            <div class="row  py-5">
                <form action="{{ route('createrestriction')}}" method="POST" enctype="multipart/form-data" class="d-flex justify-content-between" >
                    @csrf
                  
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        
                            <label for="amenity_name" class="form-label">Restriction name</label>
                            <input type="text" name="restriction_name" class="form-control" placeholder="Enter name of the restriction" required>
                        
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <label for="fileupload">Upload icon</label>
                        <input type="file" class="form-control" name="fileupload" required>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <label for="addbtn">Add Restriction</label>
                        <button class="btn btn-success form-control" type="submit" style="color: white;">Add</button>
                    </div>
                </form>

            </div>
        </div>

        <div class="container my-2">
            <h1 class="mb-4">All Restrictions</h1>
            <table id="myTable" class="display">
				<thead>
					<tr>
						<th>id</th>
						<th>Restriction Name</th>
						
						<th>Restriction icon</th>

						<th>Delete</th>
						
						
					</tr>
				</thead>
				<tbody>
					<?php $counter = 1; ?>
					@foreach ($restrictions as $item)
						<tr>
							<td>{{ $counter }}</td>
							<td>{{ $item->restriction_name }}</td>
							
                            @if ($item->restriction_icon)
                                <td><img src="https://new.jayga.io/uploads/{{ $item->restriction_icon }}" alt=""></td>
                            @else
                                <td>No icon found</td>
                            @endif

							

							<td><a class="btn btn-danger" href="/admin/delete/restriction/{{ $item->id }}">Delete</a></td>

							
							
							
							
						</tr>
						<?php $counter++; ?>
					@endforeach
				</tbody>
			</table>
        </div>
    </div>
    
@endsection