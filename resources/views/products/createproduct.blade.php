@extends('layouts.app')


@section('content')
<div class="row m-0">
	
	<div class="col-2 p-0">
		<div class="left_sidebar">
			@include('inc.sidebar')
		</div>
	</div>

	<div class="col-10 p-0">

      @include('inc.navbar')

		@include('inc.message')

		<div class="main_content">

			
			<a href="{{url('products')}}" class="return_url">< Quay lại danh sách sản phẩm</a>
			<h2 class="main_content__title">Thông tin sản phẩm</h2>
         
         {!! Form::open([ 'action' => 'ProductsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data' ]) !!}

         <div class="row">
            
            <div class="col-8">
               
               <div class="product_info">

                  <div class="row">
                  
                     <div class="col-12">
                     
                        <div class="form-label-group">
                           <input type="text" id="product_name" class="form-control" placeholder="Tên sản phẩm" name="product_name" autofocus>
                           <label for="product_name">Tên sản phẩm</label>
                        </div>

                     </div>

                  </div>
                  

                  <div class="row">
                     <div class="col-4">
                        <div class="form-label-group">
                           <input type="text" id="product_sku" class="form-control" placeholder="SKU sản phẩm" name="product_sku" autofocus>
                           <label for="product_sku">Mã sản phẩm (mã kho)</label>
                        </div>
                     </div>

                     <div class="col-4">
                        <div class="form-label-group">
                           <input type="text" id="product_code" class="form-control" placeholder="Code sản phẩm" name="product_code" autofocus>
                           <label for="product_code">Mã sản phẩm (kế toán)</label>
                        </div>
                     </div>

                     <div class="col-4">
                        <div class="form-label-group">
                           
                           <select name="unit" id="" class="form-control" style="padding: var(--input-padding-y) var(--input-padding-x)">
                              <option value="s_box">Hộp</option>
                              <option value="bottle">Chai</option>
                              <option value="b_box">Thùng</option>
                           </select>
                           
                        </div>
                     </div>


                  </div>

                  <div class="row">
                     <div class="col-12">
                        <div class="form-label-group">
                           <textarea name="product_note" id="product_note" rows="8" placeholder="Nhập ghi chú cho sản phẩm (Tuỳ chọn)"></textarea>
                        </div>

                        <input type="submit" value="Đăng Sản Phẩm">
                     </div>
                  </div>

               </div>

            </div>

            <div class="col-4">
               <div class="product_info">


                  <div class="form-group">
                        <label for="selectType">Danh mục sản phẩm</label>

                        <select multiple class="form-control" id="selectType" name="category">

                           <?php

                              if ( count( $category ) > 0 ) {
                                 foreach( $category as $cate ) {
                                    ?> <option value="<?php echo $cate->id; ?>"><?php echo $cate->cate_name; ?></option> <?php
                                 }
                              }

                            ?>
                        </select>
                     </div>


               </div>

               <div class="product_info text-center">
                  <input type="file" placeholder="Upload" class="upload_img" name="product_thumbnail">
                  <img class="img_preview">
               </div>

            </div>

         </div>

         {!! Form::close() !!}


		</div>
	</div>

</div>

@endsection


