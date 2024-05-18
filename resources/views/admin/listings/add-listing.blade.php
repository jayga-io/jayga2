@extends('admin.layouts')
@section('content')
    <div class="my-5">
        <h1>Create a new listing</h1>
        
            <div class="row">
                <form class="d-flex  my-3" action="{{route('createlistingadmin')}}" method="POST">
					@csrf
                    <div class="col-md-8">

						<div class="mb-3">
							<label for="userselect" class="form-label">Select a user</label>
							<select class="form-select" class="form-control" name="user" aria-label="Default select example">
								<option selected>Select user to assign</option>
								@foreach ($users as $item)
									<option value="{{$item->id}}">{{$item->name}}</option>
								@endforeach
								
								
							  </select>
						</div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Listing title</label>
                            <input type="text" name="listing_title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                        </div>
                        <div class="mb-5">
                            <label for="listingtype1" class="form-label">Choose property type</label>
                            <select class="form-control" id="listingtype1" name="listing_type" aria-label="Default select example">
                                <option selected>Select listing type</option>
                                <option value="room">Room</option>
                                <option value="apartment">Apartment</option>
                                <option value="hotel">Hotel</option>
                                <option value="parking">Parking</option>
                                <option value="storage">Storage</option>
                            </select>
                        </div>
                        <div class="mb-3 form-check">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <p class="text-dark">Guests</p>
                                        </div>
                                        <div class="input-group w-auto justify-content-end align-items-center">
                                            <input type="button" value="-"
                                                class="button-minus border rounded-circle  icon-shape icon-sm mx-1 "
                                                data-field="guest_num">
                                            <input type="number" step="1" max="10" value="1"
                                                name="guest_num" class="quantity-field border-0 text-center w-25">
                                            <input type="button" value="+"
                                                class="button-plus border rounded-circle icon-shape icon-sm "
                                                data-field="guest_num">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <p class="text-dark">Bedroom</p>
                                        </div>
                                        <div class="input-group w-auto justify-content-end align-items-center">
                                            <input type="button" value="-"
                                                class="button-minus border rounded-circle  icon-shape icon-sm mx-1 "
                                                data-field="bed_num">
                                            <input type="number" step="1" max="10" value="1"
                                                name="bed_num" class="quantity-field border-0 text-center w-25">
                                            <input type="button" value="+"
                                                class="button-plus border rounded-circle icon-shape icon-sm lh-0"
                                                data-field="bed_num">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <p class="text-dark">Bathroom</p>
                                        </div>
                                        <div class="input-group w-auto justify-content-end align-items-center">
                                            <input type="button" value="-"
                                                class="button-minus border rounded-circle  icon-shape icon-sm mx-1 lh-0"
                                                data-field="bathroom_num">
                                            <input type="number" step="1" max="10" value="1"
                                                name="bathroom_num" class="quantity-field border-0 text-center w-25">
                                            <input type="button" value="+"
                                                class="button-plus border rounded-circle icon-shape icon-sm lh-0"
                                                data-field="bathroom_num">
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>

						<div class="mb-3">
							<label for="listingprice" class="form-label">Set price for whole day (Slot prices will be calculated automatically)</label>
							<input type="number" class="form-control" name="listing_price" id="listingprice">
						</div>

						<div class="mb-3">
							<label for="listingdescription" class="form-label">Listing Description</label>
							<textarea name="listing_desc" id="listingdescription" class="form-control" cols="30" rows="10"></textarea>
						</div>

					</div>
					<div class="col-md-4 mx-3">
						<div class="mb-3">
							<label for="district" class="form-label">Select location</label>
							<select class="form-control" name="district" aria-label="Default select example">
								<option selected>Select a district</option>
								@foreach ($locations as $item)
								
									<option value="{{$item['name']}}">{{$item['name']}}</option>
								@endforeach
								
								
								
							</select>
						</div>

						<div class="mb-5">
							<label for="listingzip" class="form-label">Zip code</label>
							<input type="number" id="listingzip" name="zip" class="form-control">
						</div>

						<div class="mb-4 form-check form-switch">
							<input type="hidden" name="short_stay" value="0">
							<input class="form-check-input" type="checkbox" name="short_stay" role="switch" id="flexSwitchCheckDefault" value="1">
							<label class="form-check-label" for="flexSwitchCheckDefault">Allow short stay</label>
						</div>

						<div class="mb-3">
							<label for="listingaddress" class="form-label">Listing Address</label>
							<textarea name="listing_address" class="form-control" id="" cols="30" rows="10"></textarea>
						</div>

						<div class="mb-3">
							<button class="btn btn-primary" type="submit"><i class="fa fa-plus" aria-hidden="true"></i> Create</button>
						</div>
					</div>
					
                </form>
            </div>
          
       
    </div>
    
@endsection
