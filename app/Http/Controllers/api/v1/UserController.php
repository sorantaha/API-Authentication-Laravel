<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;

class UserController extends Controller
{
    function testToken(){
        return auth()->user();
    }
}
