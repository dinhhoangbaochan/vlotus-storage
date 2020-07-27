<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExportOrder;
use DB;
use App\Products;
use App\ProductsInStorage;

class ExportOrderController extends Controller
{

	public function allExport() {
		return "all Export";
	}

    public function createExport($location_id) {
    	return view('order.export.create');
    	// return $location_id;
    }

    public function search(Request $request) {

    	$exportable = ProductsInStorage::where('location', '=', 1)->get();

		if($request->get('input')){
			return $exportable->p_id;
		}
    }

}
