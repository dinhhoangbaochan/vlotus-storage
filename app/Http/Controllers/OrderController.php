<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;


class OrderController extends Controller
{
    // Authentication 
    public function __construct()
    {
        $this->middleware('auth');
    }

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

}
