<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExpirationController extends Controller
{
    public function index() {
        return view('expiration.index');
    }
}
