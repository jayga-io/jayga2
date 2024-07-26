@extends('admin.layouts')
@section('content')
    <div class="my-5 ">
        <h1>Add some images</h1>
        <div class="row mx-5">

            <form action="{{ route('savenewlisting') }}" class="my-3" method="POST" id="imageForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="listing_id" value="{{ $listing_id }}">
                <div class="my-3 ">
                    <input type="file" name="listing_images[]" id="listing-image" multiple required>
                    <label for="listing-image" class="form-label">Please upload multiple images ( Maximum 7 photos can be added)</label>
                    <button type="submit" class="btn btn-primary mx-5"><i class="fa fa-plus" aria-hidden="true"></i>
                        Add</button>
                </div>

            </form>
        </div>
        <script>
            document.getElementById('imageForm').addEventListener('submit', function(event) {
                const fileInput = document.getElementById('listing-image');
                const files = fileInput.files;

                if (files.length > 7) {
                    alert('You can only upload a maximum of 7 images');
                    event.preventDefault();
                }
            });
        </script>
    </div>
@endsection
