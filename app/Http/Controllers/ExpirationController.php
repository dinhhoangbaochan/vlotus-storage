<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductsInStorage;

class ExpirationController extends Controller
{
    public function index() {

        $productsInStorage = ProductsInStorage::all();

        $data = array(
            'productsInStorage'     =>      $productsInStorage,
        );

        return view('expiration.index')->with($data);
    }
}
