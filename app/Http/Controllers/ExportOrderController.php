<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExportOrder;
use DB;
use App\Products;
use App\ProductsInStorage;
use App\Expiration;

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
        		$output .= '<a href="" class="dropdown-item export-dropdown" data-id="' .$prd->id. '" >' . $prd->name . '</a>';
        		
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
        $order->expiration = serialize($request->expirationList);
        $order->status = "wait";
        $order->deadline = $deadline;


        $order->save();

        return response()->json(['url' => url('orders/export')]);

    }

    public function findProduct(Request $request) {
        $current_id = $request->get('currentID');
        if ( $current_id ) {
            $find_product = DB::table('products')
            ->where('id', $current_id)
            ->get();

            foreach ($find_product as $product) {
                $response_array = array(
                    'id'        =>      $product->id,
                    'name'      =>      $product->name,
                    'sku'       =>      $product->sku,
                    'img'       =>      $product->product_image,
                    'price'     =>      $product->price,
                );
            }

            $encode_res = json_encode($response_array);

            echo $encode_res;

        } else {
            echo "Unable to find what you've clicked";
        }
    }

    public function single($id) {
        $currentExportOrder = ExportOrder::find($id);
        $orderProducts = unserialize( $currentExportOrder->products );
        $originalExpiration = $currentExportOrder->expiration;
        $expiration = unserialize( $originalExpiration );
        $location = $currentExportOrder->location;
        $Products = new Products;


        $data = array(
            'currentExportOrder'    =>  $currentExportOrder,
            'orderID'               =>  $id,
            'orderProducts'         =>  $orderProducts,
            'Products'              =>  $Products,
            'location'              =>  $location,
            'expiration'            =>  $expiration,
            'originalExpiration'    =>  $originalExpiration,
        );
        return view('order.export.single')->with($data);
    }

    // Approve Order
    public function approve($id) {

        $order = ExportOrder::find($id);

        $order->status = "approve";
        $order->save();

        return redirect('export/' . $id)->with('success', 'Trạng thái đơn hàng đã chuyển sang duyệt');

    }

    // Confirm order
    public function confirm($id) {

        // $id = $request->orderID;
        // $location = $request->location;

        $order = ExportOrder::find($id);
        $productsInOrder = unserialize($order->products);
        $location = $order->location;
        $expiration = unserialize($order->expiration);

        $order->status = "confirm";
        $order->save();

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

        foreach ($expiration as $productID => $expirationArr) {
            $exp = Expiration::where('location', $location)->where('p_id', $productID)->first();

            $exp->date = serialize($expirationArr);
            $exp->save();
        }

        return redirect('orders/export')->with('success' , 'Complete');


    }

    public function loadExpiration(Request $request) {
        $id = $request->id;
        $location = $request->location;

        $expiration = DB::table('expiration')
            ->where('p_id', $id)
            ->where('location', $location)
            ->get();

        foreach ($expiration as $object) {
            return unserialize($object->date) ;
        }

    }


}


