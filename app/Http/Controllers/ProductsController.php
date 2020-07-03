<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;

class ProductsController extends Controller
{
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
        // Create product
        return view('products.createproduct');
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
            'amount'  =>  'required',
            'unit'  =>  'required',
        ]);

        // Get authenticated user ( current user )
        $current_user = auth()->user();

        // Create products
        $products = new Products;
        $products->product_name = $request->input('product_name');
        $products->product_sku = $request->input('product_sku');
        $products->product_code = $request->input('product_code');
        $products->product_price = $request->input('product_price');
        $products->amount = $request->input('amount');
        $products->unit = $request->input('unit');
        $products->status = $request->input('status');
        $products->by = $current_user->id;

        $products->save();

        return redirect('/products')->with('success', 'Đăng thành công');

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
        return view('products.edit')->with('products', $products);
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
            'amount'  =>  'required',
            'unit'  =>  'required',
        ]);

        // Get authenticated user ( current user )
        $current_user = auth()->user();

        // Update products
        $products = Products::find($id);
        $products->product_name = $request->input('product_name');
        $products->product_sku = $request->input('product_sku');
        $products->product_code = $request->input('product_code');
        $products->product_price = $request->input('product_price');
        $products->amount = $request->input('amount');
        $products->unit = $request->input('unit');
        $products->status = $request->input('status');
        $products->by = $current_user->id;

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
}
