<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductBrand;

class ProductBrandController extends Controller
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
        $brand_list = ProductBrand::all();
        return view('products.brand')->with('brand_list', $brand_list);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // Validate
        $this->validate($request, [
            'brand_name'  =>  'required',
        ]);

        // Define Model 
        $brand = new ProductBrand;

        // Get Input & Save 
        $brand->brand_name = $request->input('brand_name');
        $brand->save();

        // Return & display message
        return redirect('/product-brand')->with('success', 'Đăng thành công');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        // Validate
        $this->validate($request, [
            'brand_name'  =>  'required',
        ]);

        // Find brand by id
        $brand = ProductBrand::find($id);

        // Get Input & Save 
        $brand->brand_name = $request->input('brand_name');
        $brand->save();

        // Return & display message
        return redirect('/product-brand')->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find brand by id
        $brand = ProductBrand::find($id);

        // Delete 
        $brand->delete();

        // Return & display message
        return redirect('/product-brand')->with('success', 'Đã xoá thương hiệu');
    }
}

