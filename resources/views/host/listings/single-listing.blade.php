<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">
  <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
  <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
  <title>Edit Listing</title>
 
</head>
<body>

<div class="container mt-5">
  <form action="/user/update-listing" method="POST" enctype="multipart/form-data">
    @csrf
  <div class="d-flex justify-content-between">
    <h2>Edit Listing</h2>
    @if ($listing[0]->isActive == true)
        <div>
          <span>Active</span>
          <div class="form-check form-switch">
            <input type="hidden" name="active" value=0>
            <input class="form-check-input" type="checkbox" role="switch" name="active" value=1 id="flexSwitchCheckChecked" checked>
            <label class="form-check-label" for="flexSwitchCheckChecked"></label>
          </div>
        
        </div>
    @else
      <div>
        <span>In-Active</span>
        <div class="form-check form-switch">
          <input type="hidden" name="active" value=0>
          <input class="form-check-input" type="checkbox" role="switch" name="active" value=1 id="flexSwitchCheckChecked">
          <label class="form-check-label" for="flexSwitchCheckChecked"></label>
        </div>
      
      </div>
    @endif
    
    
  </div>
  
 
    <!-- Listing Details -->
    <input type="hidden" name="listing_id" value="{{$listing[0]->listing_id}}">
    <div class="mb-3">
      <label for="listingTitle" class="form-label">Listing Title</label>
      <input type="text" class="form-control" id="listingTitle" name="listing_title" value="{{$listing[0]->listing_title}}" required>
    </div>

    <div class="mb-3">
      <label for="listingDescription" class="form-label">Listing Description</label>
      <textarea class="form-control" id="listingDescription" name="listing_description" placeholder="{{$listing[0]->listing_description}}" rows="4" required></textarea>
    </div>
    <div class="mb-3">
      <label for="listingDescription" class="form-label">Listing Address</label>
      <textarea class="form-control" id="listingDescription" name="listing_address" placeholder="{{$listing[0]->listing_address}}" rows="4" required></textarea>
    </div>

    <div class="mb-3">
        <label for="listingTitle" class="form-label">Full Day Price</label>
        <input type="text" class="form-control" id="listingTitle" name="price" value="{{$listing[0]->full_day_price_set_by_user}}" required>
      </div>

    <div class="row d-flex">
      <!-- Amenities Restrictions -->
      <div class="col-md-6 mb-3">
        <label class="form-label">Amenities</label>
        <div class="input-text">
          <div class="input-div">
      
      
            <input type="hidden" name="wifi" value="0">
            @if ($amenities[0]->wifi == 0)
                <input type="checkbox" name="wifi" value=1>
            @else
                <input type="checkbox" name="wifi" value=1 checked>
            @endif
            
            <label>Wifi</label>
          </div>
          <div class="input-div">
            <input type="hidden" name="tv" value="0">
            @if ($amenities[0]->tv == 0)
                <input type="checkbox" name="tv" value=1>
            @else
                <input type="checkbox" name="tv" value=1 checked>
            @endif

            
            <label>TV</label>
          </div>
        </div>
        <div class="input-text">
          <div class="input-div">
            <input type="hidden" name="kitchen" value="0">
            @if ($amenities[0]->kitchen == 0)
                <input type="checkbox" name="kitchen" value=1>
            @else
                <input type="checkbox" name="kitchen" value=1 checked>
            @endif
            
            <label>Kitchen</label>
          </div>
          <div class="input-div">
            <input type="hidden" name="washing_machine" value="0">
            @if ($amenities[0]->washing_machine == 0)
                <input type="checkbox" name="washing_machine" value=1>
            @else
                <input type="checkbox" name="washing_machine" value=1 checked>
            @endif
            
            <label>Washing Machine</label>
          </div>
        </div>
        <div class="input-text">
          <div class="input-div">
            <input type="hidden" name="free_parking" value="0">
            @if ($amenities[0]->free_parking == 0)
                <input type="checkbox" name="free_parking" value=1>
            @else
                <input type="checkbox" name="free_parking" value=1 checked>
            @endif
            
            <label>Free Parking</label>
          </div>
          <div class="input-div">
            <input type="hidden" name="breakfast_included" value="0">
            @if ($amenities[0]->breakfast_included == 0)
                <input type="checkbox" name="breakfast_included" value=1>
            @else
                <input type="checkbox" name="breakfast_included" value=1 checked>
            @endif
            
            <label for="">Breakfast Included</label>
          </div>
        </div>
        <div class="input-text">
          <div class="input-div">
            <input type="hidden" name="air_condition" value="0">
            @if ($amenities[0]->air_condition == 0)
                <input type="checkbox" name="air_condition" value=1>
            @else
                <input type="checkbox" name="air_condition" value=1 checked>
            @endif
            
            <label for="">Air Condition</label>
          </div>
          <div class="input-div">
            <input type="hidden" name="dedicated_workspace" value="0">
            @if ($amenities[0]->dedicated_workspace == 0)
                <input type="checkbox" name="dedicated_workspace" value=1 data-toggle="toggle" data-onstyle="success"
              data-offstyle="danger">
            @else
                <input type="checkbox" name="dedicated_workspace" value=1 data-toggle="toggle" data-onstyle="success"
                    data-offstyle="danger" checked>
            @endif
            
            <label for="">Dedicated Workspace</label>
          </div>
        </div>
        <div class="input-text">
          <div class="input-div">
            <input type="hidden" name="gym" value="0">
            @if ($amenities[0]->gym == 0)
                <input type="checkbox" name="gym" value=1>
            @else
                <input type="checkbox" name="gym" value=1 checked>
            @endif
            
            <label for="">Gym</label>
          </div>
          <div class="input-div">
            <input type="hidden" name="beach_lake_access" value="0">
            @if ($amenities[0]->beach_lake_access == 0)
                <input type="checkbox" name="beach_lake_access" value=1>
            @else
                <input type="checkbox" name="beach_lake_access" value=1 checked>
            @endif
            
            <label for="">Beach Access</label>
          </div>
        </div>
        <div class="input-text">
          <div class="input-div">
            <input type="hidden" name="fire_extinguish" value="0">
            @if ($amenities[0]->fire_extinguish == 0)
                <input type="checkbox" name="fire_extinguish" value=1 data-toggle="toggle" data-onstyle="success"
              data-offstyle="danger">
            @else
            <input type="checkbox" name="fire_extinguish" value=1 data-toggle="toggle" data-onstyle="success"
            data-offstyle="danger" checked>
            @endif
            
            <label>Fire Ext</label>
          </div>
          <div class="input-div">
            <input type="hidden" name="cctv" value="0">
            @if ($amenities[0]->cctv == 0)
                <input type="checkbox" name="cctv" value=1 data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
            @else
            <input type="checkbox" name="cctv" value=1 data-toggle="toggle" data-onstyle="success" data-offstyle="danger" checked>
            @endif
            
            <label for="">CCTV</label>
          </div>
        </div>
        <!-- Add more amenities checkboxes as needed -->
      </div>
      
      
      <!--Restrictions-->
      <div class="col-md-6 mb-3">
        <label class="form-label">Restrictions</label>
        <div class="input-text">
          <div class="input-div">
        
        
            <input type="hidden" name="indoor_smoking" value="0">
            @if ($restrictions[0]->indoor_smoking == 0)
                 <input type="checkbox" name="indoor_smoking" value=1 data-toggle="toggle" data-onstyle="success"
              data-offstyle="danger">
            @else
            <input type="checkbox" name="indoor_smoking" value=1 data-toggle="toggle" data-onstyle="success"
            data-offstyle="danger" checked>
            @endif
           
            <label>Indoor Smoking</label>
          </div>
          <div class="input-div">
            <input type="hidden" name="party" value="0">
            @if ($restrictions[0]->party == 0)
                <input type="checkbox" name="party" value=1 data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
            @else
            <input type="checkbox" name="party" value=1 data-toggle="toggle" data-onstyle="success" data-offstyle="danger" checked>
            @endif
            
            <label>Party</label>
          </div>
        </div>
        <div class="input-text">
          <div class="input-div">
            <input type="hidden" name="pets" value="0">
            @if ($restrictions[0]->pets == 0)
                <input type="checkbox" name="pets" value=1 data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
            @else
            <input type="checkbox" name="pets" value=1 data-toggle="toggle" data-onstyle="success" data-offstyle="danger" checked>
            @endif
            
            <label>Pets</label>
          </div>
          <div class="input-div">
            <input type="hidden" name="late_night_entry" value="0">
            @if ($restrictions[0]->late_night_entry == 0)
                <input type="checkbox" name="late_night_entry" value=1 data-toggle="toggle" data-onstyle="success"
              data-offstyle="danger">
            @else
            <input type="checkbox" name="late_night_entry" value=1 data-toggle="toggle" data-onstyle="success"
            data-offstyle="danger" checked>
            @endif
            
            <label>Late Night Entry</label>
          </div>
        </div>
        <div class="input-text">
          <div class="input-div">
            <input type="hidden" name="unknown_guest_entry" value="0">
            @if ($restrictions[0]->unknown_guest_entry == 0)
                <input type="checkbox" name="unknown_guest_entry" value=1 data-toggle="toggle" data-onstyle="success"
              data-offstyle="danger">
            @else
            <input type="checkbox" name="unknown_guest_entry" value=1 data-toggle="toggle" data-onstyle="success"
            data-offstyle="danger" checked>
            @endif
            
            <label>Unknown Guest Entry</label>
          </div>
        
        </div>
        <!-- Add more amenities checkboxes as needed -->
        <div class="input-text mt-5">
          <label>Select Listing Type</label>
          <select name="listing_type" class="form-control" >
              <option value="{{$listing[0]->listing_type}}">{{$listing[0]->listing_type}}</option>
              <option value="room">Room</option>
              <option value="apartment">Apartment</option>
              <option value="hotel">Hotel</option>
              <option value="cabin">Cabin</option>
              <option value="lounge">Lounge</option>
              <option value="farm">Farm</option>
              <option value="suit">Suit</option>
      
          </select>
      
      
      </div>
      </div>
    </div>
   


    <!-- Images -->

    <div class="mb-3">
      <div class="row">
        @if (count($images)>0)
            @foreach ($images as $item)
                <div class="col-lg-4 col-md-12 mt-4 mb-4 mb-lg-0">
                    <img
                        src="{{asset('/uploads/'. $item->listing_targetlocation)}}"
                        class="w-100 h-64 shadow-1-strong rounded mb-4"
                        alt="listing_images"
                    />
                </div>
            @endforeach
        @else
                        <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                          <span>No images found</span>
                        </div>
        @endif
        <div class="col-lg-4 col-md-12 mb-4 mb-lg-0 mx-5 " style="border: 2px dashed">
          <div class="text-center me-auto align-items-center">
            <label for="">Add more images</label>
            <input type="file" class="form-control" name="ls-image[]" multiple>
          </div>
            
          </div>
          
        
      
      </div>
    </div>
    <div class="mb-3">
      <label for="imageUpload" class="form-label">Change listing Images</label>
      <input type="file" class="form-control" id="imageUpload" name="images[]" accept="image/*" multiple>
    </div>

    <button type="submit" class="btn btn-success">Submit</button>
    <a href="{{route('alllistings')}}" class="btn btn-warning">Back to listing</a>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
