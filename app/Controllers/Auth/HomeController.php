<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;

class HomeController extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }
}