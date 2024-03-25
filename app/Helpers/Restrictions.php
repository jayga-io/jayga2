<?php

use App\Models\RestrictionList;

function restrictions($data){
    $res = new RestrictionList();
    $res->fill($data);
    $res->save();

    return $res;
}

