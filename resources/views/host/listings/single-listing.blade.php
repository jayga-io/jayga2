<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">
  
  <title>Edit Listing</title>
</head>
<body>

<div class="container mt-5">
  <div class="d-flex justify-content-between">
    <h2>Edit Listing</h2>
    <h2>Active</h2>
  </div>
  
  <form action="/update-listing" method="post" enctype="multipart/form-data">
    @csrf
    <!-- Listing Details -->
    <input type="hidden" name="listing_id" value="{{$listing[0]->listing_id}}">
    <div class="mb-3">
      <label for="listingTitle" class="form-label">Listing Title</label>
      <input type="text" class="form-control" id="listingTitle" name="listing_title" placeholder="{{$listing[0]->listing_title}}" required>
    </div>

    <div class="mb-3">
      <label for="listingDescription" class="form-label">Listing Description</label>
      <textarea class="form-control" id="listingDescription" name="listing_description" placeholder="{{$listing[0]->listing_decription}}" rows="4" required></textarea>
    </div>

    <div class="row d-flex">
      <!-- Amenities Restrictions -->
      <div class="col-md-6 mb-3">
        <label class="form-label">Amenities</label>
        <div class="input-text">
          <div class="input-div">
      
      
            <input type="hidden" name="wifi" value="0">
            @if ($amenities[0]->wifi == 0)
                <input type="checkbox" name="wifi" value="1">
            @else
                <input type="checkbox" name="wifi" value="1" checked>
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
                
            @else
                
            @endif
            <input type="checkbox" name="indoor_smoking" value=1 data-toggle="toggle" data-onstyle="success"
              data-offstyle="danger">
            <label>Indoor Smoking</label>
          </div>
          <div class="input-div">
            <input type="hidden" name="party" value="0">
            @if ($restrictions[0]->indoor_smoking == 0)
                
            @else
                
            @endif
            <input type="checkbox" name="party" value=1 data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
            <label>Party</label>
          </div>
        </div>
        <div class="input-text">
          <div class="input-div">
            <input type="hidden" name="pets" value="0">
            @if ($restrictions[0]->indoor_smoking == 0)
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
          <select name="listing_type" class="form-control">
              <option>Select</option>
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
      <label for="imageUpload" class="form-label">Upload Images</label>
      <input type="file" class="form-control" id="imageUpload" name="images[]" accept="image/*" multiple>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
