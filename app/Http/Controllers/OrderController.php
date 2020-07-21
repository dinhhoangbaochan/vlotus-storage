<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Products;
use DB;


class OrderController extends Controller
{
    // Authentication 
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    // Render all orders page
    public function allOrder()
    {
    	return view('order.all_order');
    }

    // Create order
    public function create()
    {
    	return view('order.create_order');
    }

    // Search 
    public function search( Request $request)
    {
    	if($request->get('input'))
        {
            $query = $request->get('input');
            $data = DB::table('products')
            ->where('name', 'LIKE', "%{$query}%")
            ->get();
            $output = '';
            foreach($data as $row)
            {
               $output .= '<a href="" class="dropdown-item" data-id="' .$row->id. '" >' . $row->name . '</a>';
           }
           $output .= '';
           echo $output;
       } else {
       		echo "Unable to find";
       }
    	
    }


    // Find selected product
    public function findProduct(Request $request)
    {
    	$current_id = $request->get('currentID');
    	if ( $current_id ) {
    		$find_product = DB::table('products')
    		->where('id', $current_id)
    		->get();

    		foreach ($find_product as $product) {
    			$response_array = array(
    				'id'		=>		$product->id,
    				'name'		=>		$product->name,
    				'sku'		=>		$product->sku,
    			);
    		}

    		$encode_res = json_encode($response_array);

    		echo $encode_res;

    	} else {
    		echo "Unable to find what you've clicked";
    	}
    	
    } 


    // Order store
    function store()
    {
        return "Hello";
    }

}
