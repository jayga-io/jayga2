@extends('admin.layouts')
@section('content')
    <div class="my-5 ">
        <h1>Add some images</h1>
        <div class="row mx-5">
            
            <form action="{{route('savenewlisting')}}" class="my-3" method="POST">
                @csrf
                <input type="hidden" name="listing_id" value="{{$listing_id}}">
                <div class="my-3 ">
                    <input type="file" name="listing-images[]"  id="listing-image" multiple required>
                    <label for="listing-image" class="form-label">Please upload multiple images</label>
                    <button type="submit" class="btn btn-primary mx-5"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>
                </div>
               
            </form>
        </div>
    </div>
@endsection
