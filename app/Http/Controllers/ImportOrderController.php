<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ImportOrder;
use App\Products;
use App\ProductsInStorage;
use DB;

class ImportOrderController extends Controller
{
    // Authentication 
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Render all orders page
    public function allOrder()
    {
        $order = Order::all();
    	return view('order.all_order')->with('order', $order);
    }

    // Create order
    public function createImport()
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


    // Import Order store
    function storeImport(Request $request)
    {   
        $qty = $request->qty;
        $location = $request->location;
        $productsInOrder = json_encode($request->products);
        $orderCode = $request->orderCode;
        $deadline = $request->deadline;

        foreach ($qty as $id => $amount) {

            $productsInStorage = ProductsInStorage::where('p_id', '=' , $id)->where('location', $location)->first();

            if ( $productsInStorage === null ) {
                $newProducts = new ProductsInStorage;

                $newProducts->p_id = $id;
                $newProducts->tmp_imp = (int)$amount;
                $newProducts->location = $location;

                $newProducts->save();
                $res = "khong ton tai";

            } else {

                $productsInStorage->p_id = $id;
                $productsInStorage->tmp_imp = $productsInStorage->tmp_imp + (int)$amount;
                $productsInStorage->location = $location;

                $productsInStorage->save();
                $res = "ton tai";

            }            

        }

        $order = new ImportOrder;
        $order->code = $orderCode;
        $order->location = $location;
        $order->products = serialize($qty);
        $order->status = "wait";
        $order->deadline = $deadline;

        $order->save();

        return response()->json(['url' => url('orders/import')]);
        return $res;

    }


    // View all import orders
    function allImport() {
        $importOrder = ImportOrder::all();
        return view('order.all_import')->with( 'importOrder', $importOrder );
    }


    // Single order controller
    function single($id) {
        $currentImportOrder = ImportOrder::find($id);
        $orderProducts = unserialize( $currentImportOrder->products );
        $Products = new Products;

        $data = array(
            'currentImportOrder'    =>  $currentImportOrder,
            'orderProducts'         =>  $orderProducts,
            'Products'              =>  $Products,
        );

        return view('order.import.single')->with( $data );
    }

    // Approve Order
    function approve($id) {

        $order = ImportOrder::find($id);

        $order->status = "approve";
        $order->save();

        return redirect('import/' . $id)->with('success', 'Trạng thái đơn hàng đã chuyển sang duyệt');

    }

    // Confirm order
    function confirm($id) {

        $order = ImportOrder::find($id);
        $order_location = $order->location;
        $productsInOrder = unserialize($order->products);

        foreach ($productsInOrder as $id => $amountInput) {
            $productsInStorage = ProductsInStorage::where('p_id', '=', $id)->where('location', $order_location)->first();

            $productsInStorage->tmp_imp = null;
            if ( $productsInStorage->amount ) {
                $productsInStorage->amount = $productsInStorage->amount + $amountInput;
            } else {
                $productsInStorage->amount = $amountInput;
            }
            

            $productsInStorage->save();

        }

        $order->status = "confirm";
        $order->save();

        return redirect('orders/import')->with('success' , 'okay');

    }

}
