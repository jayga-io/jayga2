@extends('admin.layouts')
@section('content')
    <div class="my-5 ">
        <h1>Add Features that you provide</h1>
        <div class="row">
            <form class="d-flex" action="{{ route('storefeatures') }}" method="POST">
                @csrf
                <input type="hidden" name="listing_id" value="{{$listing_id}}">
                <div class="col-md-4 mx-5">
                    <h4 class="my-3">Add Amenities</h4>
                    @foreach ($amenities as $item)
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" name="amenities[]" value="{{ $item->id }}"
                                id="customSwitch{{ $item->id }}">
                            <label class="custom-control-label"
                                for="customSwitch{{ $item->id }}">{{ $item->amenities_name }}</label>
                        </div>
                    @endforeach

                </div>

                <div class="col-md-4 mx-5">
                    <h4 class="my-3">Add Restrictions</h4>
                    @foreach ($restrictions as $item)
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" name="restrictions[]"
                                value="{{ $item->id }}" id="customSwitchR{{ $item->id }}">
                            <label class="custom-control-label"
                                for="customSwitchR{{ $item->id }}">{{ $item->restriction_name }}</label>
                        </div>
                    @endforeach
                    
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>
                </div>
            
            </form>
        </div>
    </div>
@endsection
