<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cookie;
use App\Models\Compte;

class DefaultController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    function home()
    {
        return view('default.home');
    }
    function withoutCookie()
    {
        //Cookie::forget('client');
        Cookie::expire('client');
        return view('default.home');
    }
}
