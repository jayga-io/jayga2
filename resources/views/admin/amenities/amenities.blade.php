@extends('admin.layouts')
@section('content')
    <div>
        <div class="container my-5">
            <h1>Amenities</h1>
            <div class="row  py-5">
                <form action="{{ route('createamenities')}}" method="POST" class="d-flex justify-content-between" enctype="multipart/form-data">
                    @csrf
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        
                            <label for="amenities_category" class="form-label">Select Category</label>
                            <select name="amenities_category" class="form-control" required>
                                <option value="accommodation">Accommodation</option>
                                <option value="entertainment">Entertainment & Relaxation</option>
                                <option value="security">Safety & Security</option>
                            </select>
                        
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        
                            <label for="amenity_name" class="form-label">Amenity name</label>
                            <input type="text" name="amenity_name" class="form-control" placeholder="Enter name of the amenity" required>
                        
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <label for="fileupload">Upload icon</label>
                        <input type="file" class="form-control" name="fileupload" required>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <label for="addbtn">Add Amenity</label>
                        <button class="btn btn-success form-control" type="submit" style="color: white;">Add</button>
                    </div>
                </form>

            </div>
        </div>

        <div class="container my-2">
            <h1 class="mb-4">All Amenities</h1>
            <table id="myTable" class="display">
				<thead>
					<tr>
						<th>id</th>
						<th>Amenity Name</th>
						<th>Amenity Category</th>
						<th>Amenity icon</th>

						<th>Delete</th>
						
						
					</tr>
				</thead>
				<tbody>
					<?php $counter = 1; ?>
					@foreach ($amenities as $item)
						<tr>
							<td>{{ $counter }}</td>
							<td>{{ $item->amenities_name }}</td>
							<td>{{ $item->amenities_category }}</td>
                            @if (count($item->amenities_icon) > 0)
                                <td><img src="https://new.jayga.io/uploads/{{ $item->amenities_icon }}" alt=""></td>
                            @else
                                <td>No icon found</td>
                            @endif
							

							

							<td><a class="btn btn-danger" href="/admin/delete/amenities/{{ $item->id }}">Delete</a></td>

							
							
							
							
						</tr>
						<?php $counter++; ?>
					@endforeach
				</tbody>
			</table>
        </div>
    </div>
    
@endsection