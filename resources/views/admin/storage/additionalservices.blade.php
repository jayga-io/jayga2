@extends('admin.layouts')
@section('content')
    <div class="my-5">
        <h1>Additional services</h1>
        <div class="row py-5">
            <form action="{{route('createservices')}}" method="POST" enctype="multipart/form-data" class="d-flex justify-content-between" >
                @csrf
              
                <div class="col-lg-3 col-md-3 col-sm-12">
                    
                        <label for="service_name" class="form-label">Service name</label>
                        <input type="text" name="service_name" class="form-control" placeholder="Enter name of the service" required>
                    
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <label for="service_icon">Upload icon</label>
                    <input type="file" class="form-control" name="service_icon" required>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12">
                    <label for="service_description">Service description:</label>
                    <textarea name="service_description" id="content" class=" form-control" required></textarea>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12">
                    <label for="addbtn">Add service</label>
                    <button class="btn btn-success form-control" type="submit" style="color: white;">Add</button>
                </div>
            </form>

        </div>

        <div class="row my-3">
            <table id="myTable" class="display">
				<thead>
					<tr>
						<th>id</th>
						<th>Service Icon</th>
						<th>Service Name</th>
						<th>Service Description</th>
                        <th>Created at</th>
						<th>Delete</th>
                        
					</tr>
				</thead>
				<tbody>
					<?php $counter = 1; ?>
                    @foreach ($services as $item)
                        <tr>
                            <td>{{$counter}}</td>
                            <td><img src="https://new.jayga.io/uploads/storage/{{$item->service_icon}}" height="32px;" width="32px;" alt=""></td>
                            <td>{{$item->service_name}}</td>
                            <td>{{$item->service_description}}</td>
                            <td>{{$item->created_at->diffForHumans()}}</td>
                            <td><a href="#" class="btn btn-danger">Delete</a></td>
                        </tr>
                        <?php $counter++; ?>
                    @endforeach
				</tbody>
			</table>
        </div>
    </div>
@endsection