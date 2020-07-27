<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Storage;
use App\ProductsInStorage;

class StorageController extends Controller
{
    public function viewAll() {
    	$storage = Storage::all();
    	return view('storage.index')->with('storage', $storage);
    }

    public function create() {
    	return view('storage.create');
    }

    public function store(Request $request) {
    	$this->validate($request, [
            'location'  =>  'required',
        ]);

    	$storage = new Storage;
    	$storage->location = $request->input('location');

    	$storage->save();

    	return redirect('storage')->with('sucess', 'Tạo kho thành công');

    }

    public function single($id) {
        $storage = Storage::find($id);
        $productsInStorage = ProductsInStorage::where('location', '=', $id)->get();

        $data = array(
            'productsInStorage' =>  $productsInStorage,
        );

        return view('storage.single')->with($data);
    }
}
