<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductsInStorage;
use App\Products;
use App\Expiration;

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

    public function single($id, $location, $key) {

        $products = new Products; 
        $productsInStorage = new ProductsInStorage;

        $data = array(
            'id'            =>          $id,
            'location'      =>          $location,
            'products'      =>          $products,
            'key'           =>          $key,
            'productsInStorage' =>      $productsInStorage,
        );
        return view('expiration.single')->with($data);
    }

    public function save(Request $request) {
        $exp = new Expiration;
        $exp->p_id = $request->pid;
        $exp->date = serialize($request->amountDate);
        $exp->location = $request->location;
        $exp->save();

        return response()->json(['url' => url('all-expiration')]);
    }

    public function all() {
        $expiration = Expiration::all();
        $productsInStorage = ProductsInStorage::all();
        $products = new Products;

        $data = array(
            'productsInStorage'     =>      $productsInStorage,
            'products'              =>      $products,
            'expiration'            =>      $expiration,
        );

        return view('expiration.all')->with($data);
    }

    public function edit($pid, $location, $id) {

        $exp = Expiration::find($id);
        $getDate = unserialize($exp->date);
        $products = new Products;
        $productsInStorage = new ProductsInStorage;

        $data = array(
            'exp'       =>      $exp,
            'getDate'      =>      $getDate,
            'products'      =>      $products,
            'id'            =>      $id,
            'pid'           =>      $pid,
            'location'      =>      $location,
            'productsInStorage' =>  $productsInStorage,
        );
        return view('expiration.edit')->with($data);
    }
}
