<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\ProductCategory;
use App\ProductBrand;


class ProductsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get products by update_at ( newest products ), get only 2 products
        // $products = Products::orderBy('updated_at','desc')->take(2)->get();
        $products = Products::orderBy('updated_at','desc')->paginate(10);
        return view('products.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = ProductCategory::all();
        $brand = ProductBrand::all();

        $args = array(
            'category'  =>  $category,
            'brand'     =>  $brand,
        );

        // Create product
        return view('products.createproduct')->with($args);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'product_name'  =>  'required',
            'product_sku'  =>  'required',
            'product_code'  =>  'required',
            'product_price'  =>  'required',
            'product_thumbnail' => 'image|nullable|max:1999',
        ]);

        // Handle file upload
        if ( $request->hasFile('product_thumbnail') ) {

            // Path 
            $destinationPath = 'uploaded';
            // Get filename with extension
            $fileNameWithExtension = $request->file('product_thumbnail')->getClientOriginalName();
            // Only get file name 
            $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            // Only get extension
            $extension = $request->file('product_thumbnail')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;

            // Upload Image 
            $path = $request->file('product_thumbnail')->move($destinationPath, $fileNameToStore);

        } else {
            $fileNameToStore = 'noimage.png';
        }

        // Get authenticated user ( current user )
        $current_user = auth()->user();

        // Create products
        $products = new Products;
        $products->name = $request->input('product_name');
        $products->sku = $request->input('product_sku');
        $products->code = $request->input('product_code');
        $products->price = $request->input('product_price');
        $products->unit = $request->input('unit');
        $products->note = $request->input('product_note');
        $products->by = $current_user->id;
        $products->product_image = $fileNameToStore;
        $products->cate = $request->input('category');
        $products->brand = $request->input('brand');
        $products->import_date = $request->input('import_date');

        $products->save();

        return redirect('/products')->with('success', 'Đăng thành công');
        
        // $test = array(
        //     'product_name'      =>      $products->product_name,
        //     'product_sku'       =>      $products->product_sku,
        //     'product_code'      =>      $products->product_code,
        //     'product_price'     =>      $products->product_price,
        //     'amount'            =>      $products->amount,
        //     'unit'              =>      $products->unit,
        //     'status'            =>      $products->status,
        //     'cat'               =>      $products->category,
        //     'import_date'       =>      $products->import_date,
        // );

        // return $test;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = Products::find($id);
        $list_cat = ProductCategory::all();
        return view('products.single')->with('products', $products);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Products::find($id);
        // $list_cat = ProductCategory::pluck('cate_name','id');
        $list_cat = ProductCategory::all();
        $list_brand = ProductBrand::all();

        $data = array(
            'products'      =>      $products,
            'list_cat'      =>      $list_cat,
            'list_brand'    =>      $list_brand,
        );

        return view('products.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'product_name'  =>  'required',
            'product_sku'  =>  'required',
            'product_code'  =>  'required',
            'product_price'  =>  'required',
            'unit'  =>  'required',
        ]);

        // Get authenticated user ( current user )
        $current_user = auth()->user();

        // Update products
        $products = Products::find($id);
        $products->name = $request->input('product_name');
        $products->sku = $request->input('product_sku');
        $products->code = $request->input('product_code');
        $products->price = $request->input('product_price');
        $products->unit = $request->input('unit');
        $products->note = $request->input('product_note');
        $products->by = $current_user->id;
        $products->cate = $request->input('cate_radio');
        $products->brand = $request->input('brand_radio');

        $products->save();

        return redirect('/products')->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = Products::find($id);
        $products->delete();

        return redirect('/products')->with('success','Đã xoá sản phẩm' );
    }

    public function deleteProduct($id) {
        return $id;
    }
}
 