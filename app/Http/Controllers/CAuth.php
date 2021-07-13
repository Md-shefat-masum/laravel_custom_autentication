<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CAuth extends Controller
{
    public static function AuthInfo()
    {
        return session()->get('user_info');
    }
}
