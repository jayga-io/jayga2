<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
    <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
    <title>Edit Listing</title>
    <style>
        .AClass {
            right: 0px;
            position: absolute;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <form action="{{ route('updatelisting') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="d-flex justify-content-between">
                <h2>Edit Listing</h2>
                @if ($listing[0]->isActive == true)
                    <div>
                        <span>Active</span>
                        <div class="form-check form-switch">
                            <input type="hidden" name="active" value=0>
                            <input class="form-check-input" type="checkbox" role="switch" name="active" value=1
                                id="flexSwitchCheckChecked" checked>
                            <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                        </div>

                    </div>
                @else
                    <div>
                        <span>In-Active</span>
                        <div class="form-check form-switch">
                            <input type="hidden" name="active" value=0>
                            <input class="form-check-input" type="checkbox" role="switch" name="active" value=1
                                id="flexSwitchCheckChecked">
                            <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                        </div>

                    </div>
                @endif


            </div>


            <!-- Listing Details -->
            <input type="hidden" name="listing_id" value="{{ $listing[0]->listing_id }}">
            <div class="mb-3">
                <label for="listingTitle" class="form-label">Listing Title</label>
                <input type="text" class="form-control" id="listingTitle" name="listing_title"
                    value="{{ $listing[0]->listing_title }}" required>
            </div>

            <div class="mb-3">
                <label for="listingDescription" class="form-label">Listing Description</label>
                <textarea class="form-control" id="listingDescription" name="listing_description" rows="4">{{ $listing[0]->listing_description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="listingDescription" class="form-label">Listing Address</label>
                <textarea class="form-control" id="listingDescription" name="listing_address" rows="4">{{ $listing[0]->listing_address }}</textarea>
            </div>

            <div class="mb-3">
                <label for="listingTitle" class="form-label">Full Day Price</label>
                <input type="text" class="form-control" id="listingTitle" name="price"
                    value="{{ $listing[0]->full_day_price_set_by_user }}">
            </div>

            <div class="row d-flex">
               


                <!--rooms -->
                <div class="col-md-4">
                  <div class="row ">
                      <div class="col-md-6">
                          <div class="card-text">Bed Number</div>
                      </div>
                      <div class="col-md-6">
                          <div class="input-group py-2">

                              <input type="button" value="-"
                                  class="button-minus border rounded-circle  icon-shape icon-sm mx-1 "
                                  data-field="bed_num">
                              <input type="number" step="1" max="10" value="{{$listing[0]->bed_num}}"
                                  name="bed_num" class="bed_num-field border-0 text-center w-25">
                              <input type="button" value="+"
                                  class="button-plus border rounded-circle icon-shape icon-sm "
                                  data-field="bed_num">
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-6">
                          <div class="card-text">Bathroom Number</div>
                      </div>
                      <div class="col-md-6">
                          <div class="input-group py-2">

                              <input type="button" value="-"
                                  class="button-minus border rounded-circle  icon-shape icon-sm mx-1 "
                                  data-field="bathroom_num">
                              <input type="number" step="1" max="10" value="{{$listing[0]->bathroom_num}}"
                                  name="bathroom_num" class="bathroom_num-field border-0 text-center w-25">
                              <input type="button" value="+"
                                  class="button-plus border rounded-circle icon-shape icon-sm "
                                  data-field="bathroom_num">
                          </div>
                      </div>
                  </div>
                  
              </div>
            </div>



            <!-- Images -->

            <div class="my-5">
                <div class="row">
                    @if (count($listing[0]->images) > 0)
                        @foreach ($listing[0]->images as $item)
                            <div class="col-lg-4 col-md-4 col-sm-12 mb-4 mb-lg-0" style="position: relative">
                                <a href="/user/remove/listing-image/{{ $item->listing_img_id }}"
                                    class="close AClass btn btn-danger">
                                    <span>&minus;</span>
                                </a>
                                <img src="{{ asset('/uploads/' . $item->listing_targetlocation) }}"
                                    class=" shadow-1-strong rounded mb-4" alt="listing_images"
                                    style="width: 100%; aspect-ratio:3/2; object-fit:contain" />
                            </div>
                        @endforeach
                    @else
                        <div class="col-lg-4 col-md-4 col-sm-12 mb-4 mb-lg-0">
                            <span>No images found</span>
                        </div>
                    @endif
                    <div class="col-lg-4 col-md-4 col-sm-12 mb-4 mb-lg-0 mx-5">


                        <input type="file" class="form-control text-center p-5 align-items-center"
                            name="lsimages[]" id="lsimage" multiple placeholder="Add More Images">
                        <label class=" form-control p-1 text-center" for="">Add more images</label>



                    </div>



                </div>
            </div>
            <div class="my-3">
                <label for="imageUpload" class="form-label">Replace all images</label>
                <input type="file" class="form-control" id="imageUpload" name="images[]" accept="image/*"
                    multiple>
            </div>

            <div class="my-3">
                <label for="video">Video link</label>
                <input type="text" class="form-control" name="video_link" placeholder="Enter video link">
            </div>

            <button type="submit" class="my-5 btn btn-success">Save</button>
            <a href="{{ route('all_listings') }}" class="btn btn-warning">Back to listing</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
      var qty = 1;
      var guest_numbr = document.getElementById('guest');

      function incrementValue(e) {
          e.preventDefault();

          var fieldName = $(e.target).data('field');
          var parent = $(e.target).closest('div');
          var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

          if (!isNaN(currentVal)) {
              parent.find('input[name=' + fieldName + ']').val(currentVal + 1);


          } else {
              parent.find('input[name=' + fieldName + ']').val(0);
              qty = 0;
          }
          qty++;
          guest_numbr.value = qty;
      }

      function decrementValue(e) {
          e.preventDefault();
          var fieldName = $(e.target).data('field');
          var parent = $(e.target).closest('div');
          var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

          if (!isNaN(currentVal) && currentVal > 0) {
              parent.find('input[name=' + fieldName + ']').val(currentVal - 1);
          } else {
              parent.find('input[name=' + fieldName + ']').val(0);
          }
          qty--;
          guest_numbr.value = qty;
      }

      $('.input-group').on('click', '.button-plus', function(e) {
          incrementValue(e);
      });

      $('.input-group').on('click', '.button-minus', function(e) {
          decrementValue(e);
      });
  </script>

</body>

</html>
