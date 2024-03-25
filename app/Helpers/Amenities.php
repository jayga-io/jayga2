<?php

use App\Models\AmenitiesList;

function amenities($data){
    $amenities = new AmenitiesList();
    $amenities->fill($data);
    $amenities->save();

    return $amenities;
}

