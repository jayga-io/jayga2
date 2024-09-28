@extends('admin.layouts')
@section('content')
    <div>
        <div class="container my-5">
            <h1>Amenities</h1>
            <div class="row  py-5">
                <form action="{{ route('createamenities')}}" method="POST" class="d-flex justify-content-between" enctype="multipart/form-data">
                    @csrf
                    <div class="col-lg-2 col-md-2 col-sm-12">
                        
                            <label for="amenities_category" class="form-label">Select Category</label>
                            <select name="amenities_category" class="form-control" required>
                                <option value="Accommodation" >Accommodation</option>
                                    <option value="Entertainment">Entertainment & Relaxation</option>
                                    <option value="Security">Safety & Security</option>
                                    <option value="Foods & Beverage">Food & Beverage</option>
                                    <option value="Additional Services">Additional Services</option>
                                    <option value="Storage Unit Features">Storage Unit Features</option>
                                    <option value="Storage Security">Storage Security</option>
                                    <option value="Additional Storage Services">Additional Storage Services</option>
                            </select>
                        
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12">
                        
                            <label for="amenity_name" class="form-label">Amenity name</label>
                            <input type="text" name="amenity_name" class="form-control" placeholder="Enter name of the amenity" required>
                        
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12">
                        
                            <label for="amenity_type" class="form-label">Amenity Type</label>
                            <select name="amenity_type" class="form-control" required>
                                <option value="listing">Listing</option>
                                <option value="storage">Storage</option>
                               
                              </select>
                        
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12">
                        <label for="fileupload" >Upload icon</label>
                        <input type="file" class="form-control" name="fileupload" required>
                    </div>

                    <div class="col-lg-2 col-md-2 col-sm-12">
                        <label for="addbtn" >Add Amenity</label>
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
                        <th>Amenity Type</th>
						<th>Amenity icon</th>

						<th>Edit</th>
						
						
					</tr>
				</thead>
				<tbody>
					<?php $counter = 1; ?>
					@foreach ($amenities as $item)
						<tr>
							<td>{{ $counter }}</td>
							<td>{{ $item->amenities_name }}</td>
							<td>{{ $item->amenities_category }}</td>
							<td>{{ $item->amenity_type }}</td>
                            @if ($item->amenities_icon)
                                <td><img src="https://new.jayga.io/uploads/{{ $item->amenities_icon }}" alt=""></td>
                            @else
                                <td>No icon found</td>
                            @endif
							

							

							<td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop" id="editbtn"
                                amn-id ="{{$item->id}}" amn-name="{{$item->amenities_name}}" amn-cat ="{{$item->amenities_category}}"
                                onclick="editAmenity(this)">Edit</button></td>

							
							
							
							
						</tr>
						<?php $counter++; ?>
					@endforeach
				</tbody>
			</table>
           
        </div>

  <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Amenity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('amenityupdate')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row my-1">
                            <input type="hidden" id="amenity_id" name="amenity_id">
                            <div class="col-12">
                                <label for="amenityname" class="form-label">Amenity name</label>
                                <input type="text" class="form-control" id="amenity_name" name="amenity_name">
                            </div>
                            <div class="col-12">
                                <label for="amenitycate" class="form-label">Amenity Category</label>
                                <select name="amenities_category" id="amenities_cat" class="form-control" required>
                                    <option selected id="opt1"></option>
                                    <option value="Accommodation" >Accommodation</option>
                                    <option value="Entertainment">Entertainment & Relaxation</option>
                                    <option value="Security">Safety & Security</option>
                                    <option value="Foods & Beverage">Food & Beverage</option>
                                    <option value="Additional Services">Additional Services</option>
                                    <option value="Storage Unit Features">Storage Unit Features</option>
                                    <option value="Storage Security">Storage Security</option>
                                    <option value="Additional Storage Services">Additional Storage Services</option>
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="amenityicon" class="form-label">Amenity Icon</label>
                                <input type="file" class="form-control" id="amenity_icon" name="amenity_icon">
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
               
            </div>
        </div>
    </div>

    <script>
        var modalName = document.querySelector('#amenity_name');
        var modalCategory = document.querySelector('#opt1');
        var modalID = document.querySelector('#amenity_id');
        function editAmenity(e){
            modalID.setAttribute('value', e.getAttribute('amn-id'));
            modalName.setAttribute('value', e.getAttribute('amn-name'));
            modalCategory.setAttribute('value', e.getAttribute('amn-cat'));
            modalCategory.innerText = e.getAttribute('amn-cat');
        }
       
    </script>
</div>
    
@endsection