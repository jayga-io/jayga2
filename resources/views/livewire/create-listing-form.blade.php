<div>
    <form wire:submit="save">
        <div class="row formtype">
    
            <div class="col-md-4">
                <div class="form-group">
                    <label>Lister ID and Name</label>
                    <select class="form-control" id="lister_id" name="lister_id">
                        <option selected="" value="">Select Lister ID and Name</option>
    
                    </select>
                </div>
            </div>
    
            
            <input type="hidden" id="selected_lister_id" name="selected_lister_id" value="">
            <input type="hidden" id="selected_lister_name" name="selected_lister_name" value="">
    
    
        
    
            <div class="col-md-4">
                <div class="form-group">
                    <label>Guest Number Allowed</label>
                    <input class="form-control" wire:model="guest_number" type="number">
                </div>
            </div>
    
    
            <div class="col-md-4">
                <div class="form-group">
                    <label>How many Bedrooms?</label>
                    <input class="form-control" wire:model="bed_number" type="number">
                    
                </div>
            </div>
    
            <div class="col-md-4">
                <div class="form-group">
                    <label>How many Bathrooms?</label>
                    <input class="form-control" wire:model="bathroom_number" type="number">

                </div>
            </div>
    
            <div class="col-md-4">
                <div class="form-group">
                    <label>Give your Listing a title</label>
                    <input class="form-control" wire:model="listing_title" type="text">
                </div>
            </div>
    
            <div class="col-md-4">
                <div class="form-group">
                    <label>Describe Listing?</label>
                    <!-- <input class="form-control" name="name" type="text" >  -->
                    <textarea class="form-control" rows="5" wire:model="listing_description"></textarea>
                </div>
            </div>
    
            <div class="col-md-4">
                <div class="form-group">
                    <label>What is the price set for a day stay?</label>
                    <input class="form-control" wire:model="full_day_price_set_by_user" type="number">
                </div>
            </div>
    
            <!-- <div class="col-md-4">
                    <div class="form-group">
                        <label>What is the price for short stay?</label>
                        <input class="form-control" name="name" type="text" > </div>
                </div> -->
    
            <div class="col-md-4">
                <div class="form-group">
                    <label>What is the listing adress?</label>
                    <input class="form-control" wire:model="listing_address" type="text">
                </div>
            </div>
    
            <div class="col-md-4">
                <div class="form-group">
                    <label>Listing zip code?</label>
                    <input class="form-control" wire:model="zip_code" type="text">
                </div>
            </div>
    
            <div class="col-md-4">
                <div class="form-group">
                    <label>Which district is it in?</label>
                    <input class="form-control" wire:model="district" type="text">
                </div>
            </div>
    
            <div class="col-md-4">
                <div class="form-group">
                    <label>Which town is it in?</label>
                    <input class="form-control" wire:model="town" type="text">
                </div>
            </div>
    
    
    
            <div class="col-md-4">
                <div class="form-group">
                    <label>Would you allow short stay?</label>
                    <br><input type="checkbox" class="form-control" wire:model="allow_short_stay"  data-toggle="toggle"
                        data-onstyle="success" data-offstyle="danger">
                        allow_short_stay : {{ var_export($allow_short_stay) }}
                </div>
            </div>
    
            <div class="col-md-4">
                <div class="form-group">
                    <label>Is it peaceful?</label>
                    <br><input type="checkbox" wire:model="describe_peaceful"   data-toggle="toggle"
                        data-onstyle="success" data-offstyle="danger">
                </div>
            </div>
    
            <div class="col-md-4">
                <div class="form-group">
                    <label>Is it unique?</label>
                    <br><input type="checkbox" wire:model="describe_unique"   data-toggle="toggle"
                        data-onstyle="success" data-offstyle="danger">
                </div>
            </div>
    
            <div class="col-md-4">
                <div class="form-group">
                    <label>Is it family friendly?</label>
                    <br><input type="checkbox" wire:model="describe_familyfriendly"   data-toggle="toggle"
                        data-onstyle="success" data-offstyle="danger">
                </div>
            </div>
    
            <div class="col-md-4">
                <div class="form-group">
                    <label>Is it stylish?</label>
                    <br><input type="checkbox" wire:model="describe_stylish" data-toggle="toggle"
                        data-onstyle="success" data-offstyle="danger">
                </div>
            </div>
    
            <div class="col-md-4">
                <div class="form-group">
                    <label>Is it central?</label>
                    <br><input type="checkbox" wire:model="describe_central"   data-toggle="toggle"
                        data-onstyle="success" data-offstyle="danger">
                </div>
            </div>
    
            <div class="col-md-4">
                <div class="form-group">
                    <label>Is it spacious?</label>
                    <br><input type="checkbox" wire:model="describe_spacious"   data-toggle="toggle"
                        data-onstyle="success" data-offstyle="danger">
                </div>
            </div>
    
    
    
            <div class="col-md-4">
                <div class="form-group">
                    <label>Does it have a private bathroom?</label>
                    <br><input type="checkbox" wire:model="private_bathroom"   data-toggle="toggle"
                        data-onstyle="success" data-offstyle="danger">
                </div>
            </div>
    
            <div class="col-md-4">
                <div class="form-group">
                    <label>Is breakfast available?</label>
                    <br><input type="checkbox" wire:model="breakfast_included"   data-toggle="toggle"
                        data-onstyle="success" data-offstyle="danger">
                </div>
            </div>
    
            <div class="col-md-4">
                <div class="form-group">
                    <label>Is room lock available?</label>
                    <br><input type="checkbox" wire:model="door_lock"   data-toggle="toggle" data-onstyle="success"
                        data-offstyle="danger">
                </div>
            </div>
    
            <div class="col-md-4">
                <div class="form-group">
                    <label>Will there be anyone else in the house?</label>
                    <br><input type="checkbox" wire:model="unknown_guest_entry"   data-toggle="toggle"
                        data-onstyle="success" data-offstyle="danger">
                </div>
            </div>
    
            <div class="col-md-4">
                <div class="form-group">
                    <label>Listing Type</label>
                    <select class="form-control" wire:model="listing_type">
                        <option>Select</option>
                        <option>Room</option>
                        <option>Appartment</option>
                        <option>Hotel</option>
                        <!-- <option>King</option>
                            <option>Suite</option>
                            <option>Villa</option> -->
                    </select>
    
                </div>
            </div>
    
            <div class="col-md-4">
                <div class="form-group">
                    <label> Upload Listing Pictures</label>
                    <div class="custom-file mb-3">
                        <!-- <input type="file" class="custom-file-input" name="user_pic[]" multiple onchange="displayFileNames(event)">
                                  <div id="file-names"></div> -->
                        <input type="file" name="listing_pictures[]" class="form-control input-lg" multiple>
                        <!-- <label class="custom-file-label" for="customFile">Choose file</label> -->
                    </div>
                </div>
            </div>
    
        </div>
        <button type="submit" class="btn btn-primary buttonedit1">Create Listing
            <div wire:loading>
                <svg>...</svg> <!-- SVG loading spinner -->
            </div>
        </button>
    </form>
</div>
