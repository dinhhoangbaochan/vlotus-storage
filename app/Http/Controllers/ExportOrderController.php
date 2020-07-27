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
    	return view('order.export.create')->with('location_id', $location_id);
    	// return $location_id;
    	
    }

    public function search(Request $request) {

    	$exportable = DB::table('products_in_storage')->where('location', 1)->get();

    	$output = '';
        foreach($exportable as $row)
        {
        	$query = $request->get('input');
        	$find = Products::where('id', $row->p_id)->where('name', 'LIKE', "%{$query}%")->get();
        	foreach ($find as $prd) {
        		$output .= '<a href="" class="dropdown-item" data-id="' .$prd->id. '" >' . $prd->name . '</a>';
        		
        	}
           
       	}
       	$output .= '';
       	echo $output;


    }

}
