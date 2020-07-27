<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExportOrder;

class ExportOrderController extends Controller
{

	public function allExport() {
		return "all Export";
	}

    public function createExport($location_id) {
    	// return view('order.export.create');
    	return $location_id;
    }
}
