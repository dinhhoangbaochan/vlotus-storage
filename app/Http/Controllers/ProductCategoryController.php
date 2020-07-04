<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductCategory;

class ProductCategoryController extends Controller
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
        $category_list = ProductCategory::all();
        return view('products.category')->with('category_list', $category_list);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Create category 
        
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
            'category_name'  =>  'required',
        ]);

        // Save data
        $product_category = new ProductCategory;

        $product_category->cate_name = $request->input('category_name');
        $product_category->save();

        return redirect('/product-category')->with('success', 'Đăng thành công');

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
        $this->validate($request, [
            'cate_name'  =>  'required',
        ]);

        // Update products
        $product_cate = ProductCategory::find($id);
        $product_cate->cate_name = $request->input('cate_name');

        $product_cate->save();

        return redirect('/product-category')->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product_cat = ProductCategory::find($id);
        $product_cat->delete();

        return redirect('/product-category')->with('success','Đã xoá danh mục' );
    }

    public function customUpdate(Request $request, $id) {
        return $id;
    }

}
