<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExportOrderController extends Controller
{
    public function createExport() {
    	return view('order.export.create');
    }
}
