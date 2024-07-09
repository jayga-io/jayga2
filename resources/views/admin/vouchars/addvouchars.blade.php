@extends('admin.layouts')
@section('content')
    <div>
        <div class="container my-5">
            <h1>Vouchars</h1>
            <div class="row  py-5">
                <form action="{{ route('createnewvouchar')}}" method="POST" class="d-flex justify-content-between" >
                    @csrf
                    
                    <div class="col-lg-2 col-md-2 col-sm-12">
                        
                            <label for="vouchar_code" class="form-label">Vouchar Code</label>
                            <input type="text" name="vouchar_code" class="form-control" placeholder="Enter vouchar code" required>
                        
                    </div>

                    <div class="col-lg-2 col-md-2 col-sm-12">
                        <label for="vouchar_value" >Voucahr value</label>
                        <input type="number" class="form-control" name="vouchar_value" required>
                    </div>

                    <div class="col-lg-2 col-md-2 col-sm-12">
                        <label for="discount_type" >Voucahr value</label>
                        <select name="discount_type" class="form-control">
                            <option value="%">% Percentage</option>
                            <option value="TK">Cash</option>
                        </select>
                    </div>

                    <div class="col-lg-2 col-md-2 col-sm-12">
                        <label for="validity_start" >Validity start</label>
                        <input type="date" class="form-control" name="validity_start" required>
                    </div>

                    <div class="col-lg-2 col-md-2 col-sm-12">
                        <label for="validity_end" >Validity end</label>
                        <input type="date" class="form-control" name="validity_end" required>
                    </div>

                    <div class="col-lg-2 col-md-2 col-sm-12">
                        <label for="addbtn" >Add Vouchar</label>
                        <button class="btn btn-success form-control" type="submit" style="color: white;">Add</button>
                    </div>
                </form>

            </div>
        </div>

        <div class="container my-2">
            <h1 class="mb-4">All Vouchars</h1>
            <table id="myTable" class="display">
				<thead>
					<tr>
						<th>id</th>
						<th>Vouchar code</th>
						<th>Vouchar value</th>
						<th>Validity From</th>
                        <th>Validity End</th>
						<th>Discount Type</th>
						<th>Created on</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>
					<?php $counter = 1; ?>
					@foreach ($vouchars as $item)
						<tr>
							<td>{{ $counter }}</td>
							<td>{{ $item->vouchar_code }}</td>
							<td>{{ $item->discount_value }}</td>
							<td>{{ $item->validity_start }}</td>
							<td>{{ $item->validity_end }}</td>
							<td>{{ $item->discount_type }}</td>
							<td>{{ $item->created_at->format('F j, Y') }}</td>
                            <td><button>Delete</button></td>
						</tr>
						<?php $counter++; ?>
					@endforeach
				</tbody>
			</table>
           
        </div>

</div>
    
@endsection