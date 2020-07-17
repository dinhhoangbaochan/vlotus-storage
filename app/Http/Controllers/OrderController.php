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
            ->where('product_name', 'LIKE', "%{$query}%")
            ->get();
            $output = '';
            foreach($data as $row)
            {
               $output .= '<a href="" class="dropdown-item" data-id="' .$row->id. '" >' . $row->product_name . '</a>';
           }
           $output .= '';
           echo $output;
       } else {
       		echo "Unable to find";
       }
    	
    }

}
