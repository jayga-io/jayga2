@extends('admin.layouts')
@section('content')
    <div class="my-5">
        <h1>Inventory Categories</h1>
        <div class="row py-5">
            <form action="{{route('createinventorytype')}}" method="POST" enctype="application/x-www-form-urlencoded" class="d-flex justify-content-between" >
                @csrf
              
                <div class="col-lg-6 col-md-6 col-sm-12">
                    
                        <label for="inventory_type" class="form-label">Inventory Type</label>
                        <input type="text" name="inventory_type" class="form-control" placeholder="Inventory Type" required>
                    
                </div>
                

                <div class="col-lg-6 col-md-6 col-sm-12">
                    <label for="addbtn">Add</label>
                    <button class="btn btn-success form-control" type="submit" style="color: white;">Add</button>
                </div>
            </form>

        </div>

        <div class="row my-3 mx-auto">
            <table id="myTable" class="display">
				<thead>
					<tr>
						<th>id</th>
						<th>Inventory Type</th>
						
                        <th>Created at</th>
						<th>Delete</th>
                        
					</tr>
				</thead>
				<tbody>
					<?php $counter = 1; ?>
                    @foreach ($types as $item)
                        <tr>
                            <td>{{$counter}}</td>
                            
                            <td>{{$item->inventory_type}}</td>
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