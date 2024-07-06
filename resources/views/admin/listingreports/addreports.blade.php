@extends('admin.layouts')
@section('content')
    <div>
        <div class="container my-5">
            <h1>Add Report category</h1>
            <div class="row  py-5">
                <form action="{{ route('addreportcategory')}}" method="POST" class="d-flex justify-content-between">
                    @csrf
                    
                    <div class="col-lg-8 col-md-8 col-sm-12">
                        
                            <label for="category_name" class="form-label">Report Category Name</label>
                            <input type="text" name="category_name" class="form-control" placeholder="Enter name of the Report Category" required>
                        
                    </div>
                    

                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <label for="addbtn" >Add Category</label>
                        <button class="btn btn-success form-control" type="submit" style="color: white;">Add</button>
                    </div>
                </form>

            </div>
        </div>

        <div class="container my-2">
            <h1 class="mb-4">All Report Categories</h1>
            <table id="myTable" class="display">
				<thead>
					<tr>
						<th>id</th>
						<th>Report Category</th>
						<th>Edit</th>
					</tr>
				</thead>
				<tbody>
					<?php $counter = 1; ?>
					@foreach ($reports as $item)
						<tr>
							<td>{{ $counter }}</td>
							
							<td>{{ $item->category_name }}</td>

							<td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop" id="editbtn"
                                report-id ="{{$item->id}}" report-cat ="{{$item->category_name}}"
                                onclick="editReport(this)">Edit</button></td>
	
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
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Report Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('updatereportcategory')}}" method="POST" >
                        @csrf
                        <div class="row my-1">
                            <input type="hidden" id="report_id" name="report_id">
                            <div class="col-12">
                                <label for="category_name" class="form-label">Report Category name</label>
                                <input type="text" class="form-control" id="category_name" name="category_name">
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
        var modalName = document.querySelector('#category_name');
        
        var modalID = document.querySelector('#report_id');
        function editReport(e){
            modalID.setAttribute('value', e.getAttribute('report-id'));
            modalName.setAttribute('value', e.getAttribute('report-cat'));
            
        }
       
    </script>
</div>
    
@endsection