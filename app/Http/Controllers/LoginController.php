<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
// use Illuminate\Http\Client\Pool;
use App\Models\User;
use App\Models\UserPictures;

class LoginController extends Controller
{
    public function login(){
        return view('client.login');
    }

   

    public function host_setup(){
        return view('host.setup.host-setup');
    }
}
