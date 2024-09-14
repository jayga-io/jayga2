@extends('admin.layouts')
@section('content')
    <div>
        <div class="container my-5">
            <h1>Restrictions</h1>
            <div class="row  py-5">
                <form action="{{ route('createrestriction')}}" method="POST" enctype="multipart/form-data" class="d-flex justify-content-between" >
                    @csrf
                  
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        
                            <label for="restriction_name" class="form-label">Restriction name</label>
                            <input type="text" name="restriction_name" class="form-control" placeholder="Enter name of the restriction" required>
                        
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        
                            <label for="restriction_name" class="form-label">Restriction type</label>
                            <input type="text" name="restriction_type" class="form-control" placeholder="Enter type of the restriction" required>
                        
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <label for="fileupload">Upload icon</label>
                        <input type="file" class="form-control" name="fileupload" required>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-12">
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

							

							<td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop" id="editbtn"
                                restriction-id ="{{$item->id}}" restriction-name="{{$item->restriction_name}}" 
                                onclick="editRestrictions(this)">Edit</button></td>

							
							
							
							
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
                <h5 class="modal-title" id="staticBackdropLabel">Edit Restriction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('restrictionupdate')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row my-1">
                        <input type="hidden" id="restriction_id" name="restriction_id">
                        <div class="col-12">
                            <label for="restrictionname" class="form-label">Restriction name</label>
                            <input type="text" class="form-control" id="restriction_name" name="restriction_name">
                        </div>
                        
                        <div class="col-12 mb-3">
                            <label for="restrictionicon" class="form-label">Restriction Icon</label>
                            <input type="file" class="form-control" id="restriction_icon" name="restriction_icon">
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
    var modalName = document.querySelector('#restriction_name');
    
    var modalID = document.querySelector('#restriction_id');
    function editRestrictions(e){
        modalID.setAttribute('value', e.getAttribute('restriction-id'));
        modalName.setAttribute('value', e.getAttribute('restriction-name'));
       
    }
   
</script>
    </div>
    
@endsection