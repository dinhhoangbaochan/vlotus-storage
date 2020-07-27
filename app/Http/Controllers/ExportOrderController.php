<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExportOrder;

class ExportOrderController extends Controller
{

	public function allExport() {
		return "all Export";
	}

    public function createExport() {
    	return view('order.export.create');
    }
}
