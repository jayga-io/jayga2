<?php 

use App\Models\Notification;

function notify($data){
    $notif = new Notification();
    $notif->fill($data);
    $notif->save();

    return $notif;
}