<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExportOrder;
use DB;
use App\Products;
use App\ProductsInStorage;

class ExportOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

	public function allExport() {
        $exportOrder = ExportOrder::all();
		return view('order.export.all_export')->with('exportOrder', $exportOrder);
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

        foreach ($qty as $id => $amount) {

            $productsInStorage = ProductsInStorage::where('p_id', '=' , $id)->where('location', $location)->first();

            $productsInStorage->tmp_exp = (int)$amount;
            $productsInStorage->save();           

        }

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

    public function single($id) {
        $currentExportOrder = ExportOrder::find($id);
        $orderProducts = unserialize( $currentExportOrder->products );
        $Products = new Products;

        $data = array(
            'currentExportOrder'    =>  $currentExportOrder,
            'orderProducts'         =>  $orderProducts,
            'Products'              =>  $Products,
        );
        return view('order.export.single')->with($data);
    }

    // Approve Order
    function approve($id) {

        $order = ExportOrder::find($id);

        $order->status = "approve";
        $order->save();

        return redirect('export/' . $id)->with('success', 'Trạng thái đơn hàng đã chuyển sang duyệt');

    }

    // Confirm order
    function confirm($id) {

        $order = ExportOrder::find($id);
        $productsInOrder = unserialize($order->products);

        foreach ($productsInOrder as $id => $amountInput) {
            $productsInStorage = ProductsInStorage::where('p_id', '=', $id)->first();

            $productsInStorage->tmp_exp = null;
            if ( $productsInStorage->amount ) {
                $productsInStorage->amount = $productsInStorage->amount - $amountInput;
            } else {
                $alert = "Nothing changed";
            }
            

            $productsInStorage->save();

        }

        $order->status = "confirm";
        $order->save();

        return redirect('orders/export')->with('success' , 'okay');

    }

}


