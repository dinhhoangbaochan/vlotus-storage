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
		return view('order.export.all_export');
	}

    public function createExport($location_id) {
    	return view('order.export.create')->with('location_id', $location_id);
    	// return $location_id;
    	
    }

    public function search(Request $request) {
    	$location = $request->location;

    	$exportable = DB::table('products_in_storage')->where('location', $location)->get();

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

    public function store(Request $request) {
        $qty = $request->qty;
        $location = $request->location;
        $productsInOrder = json_encode($request->products);
        $orderCode = $request->orderCode;
        $deadline = $request->deadline;

        // foreach ($qty as $id => $amount) {

        //     $productsInStorage = ProductsInStorage::where('p_id', '=' , $id)->first();

        //     if ( $productsInStorage === null ) {
        //         $newProducts = new ProductsInStorage;

        //         $newProducts->p_id = $id;
        //         $newProducts->tmp_imp = (int)$amount;
        //         $newProducts->location = $location;

        //         $newProducts->save();
        //         $res = "khong ton tai";

        //     } else {

        //         $productsInStorage->p_id = $id;
        //         $productsInStorage->tmp_imp = $productsInStorage->tmp_imp + (int)$amount;
        //         $productsInStorage->location = $location;

        //         $productsInStorage->save();
        //         $res = "ton tai";

        //     }            

        // }

        $order = new ExportOrder;
        $order->code = $orderCode;
        $order->location = $location;
        $order->products = serialize($qty);
        $order->status = "wait";
        $order->deadline = $deadline;

        $order->save();

        return response()->json(['url' => url('orders/export')]);
        return $res;

    }

}


