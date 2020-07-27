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

    	$exportable = DB::table('products_in_storage')->where('location', 2)->get();

    	$output = '';
        foreach($exportable as $row)
        {
        	$find = Products::where('id', $row->p_id)->get();
        	foreach ($find as $prd) {
        		$output .= '<a href="" class="dropdown-item" data-id="' .$prd->id. '" >' . $prd->name . '</a>';
        	}
           
       	}
       	$output .= '';
       	echo $output;


    }

}
