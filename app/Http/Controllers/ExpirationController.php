<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductsInStorage;
use App\Products;

class ExpirationController extends Controller
{
    public function index() {

        $productsInStorage = ProductsInStorage::all();
        $products = new Products;

        $data = array(
            'productsInStorage'     =>      $productsInStorage,
            'products'              =>      $products,
        );

        return view('expiration.index')->with($data);
    }
}
