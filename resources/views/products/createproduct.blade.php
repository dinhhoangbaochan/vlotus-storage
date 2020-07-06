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

		<div class="top_bar">
			<a href="/products" class="btn btn-danger">Huỷ</a>
			<a href="" class="btn btn-success">Trợ Giúp</a>

		</div>

		@include('inc.message')

		<div class="main_content">
			
			<a href="/products" class="return_url">< Quay lại danh sách sản phẩm</a>
			<h2 class="main_content__title">Nhập sản phẩm mới</h2>

			<div class="product_info">
				{!! Form::open([ 'action' => 'ProductsController@store', 'method' => 'POST', ]) !!}

               <div class="row">
                  
                  <div class="col-12">
                     <div class="form-group">
                        {{Form::label('', 'Tên sản phẩm')}}
                        {{Form::text('product_name','', ['placeholder' => 'Product Name', 'class' => 'form-control test'] )}}
                     </div>
                  </div>

                  <div class="col-6">
                     <div class="form-group">
                        {{Form::label('', 'Mã sản phẩm (SKU)')}}
                        {{Form::text('product_sku','', ['placeholder' => 'Mã SKU', 'class' => 'form-control test'] )}}
                     </div>
                  </div>

                  <div class="col-6">
                     <div class="form-group">
                        {{Form::label('', 'Mã báo cáo')}}
                        {{Form::text('product_code','', ['placeholder' => 'Mã báo cáo', 'class' => 'form-control test'] )}}
                     </div>
                  </div>

                  <div class="col-6">
                     <div class="form-group">
                        {{Form::label('', 'Giá tiền')}}
                        {{Form::text('product_price','', ['placeholder' => 'Giá tiền', 'class' => 'form-control'] )}}
                     </div>
                  </div>

                  <div class="col-6">
                     <div class="form-group">
                        {{Form::label('', 'Số lượng')}}
                        {{Form::number('amount','', ['placeholder' => 'Số lượng', 'class' => 'form-control'] )}}
                     </div>
                  </div>

                  <div class="col-6">
                     <div class="form-group">
                        {{Form::label('', 'Đơn vị')}}
                        {{Form::text('unit','', ['placeholder' => 'Đơn vị', 'class' => 'form-control'] )}}
                     </div>
                  </div>

                  <div class="col-6">
                     <div class="form-group">
                        {{Form::label('', 'Trạng Thái')}}
                        {{Form::select('status', [
                           'on-deliver'   => 'Đang Giao Hàng', 
                           'left'         => 'Tồn Kho', 
                           'completed'    => 'Hoàn Tất',
                           'in-payment'   => 'Chờ Thanh Toán',
                           ], 'on-deliver', ['class' => 'form-control'])}}
                     </div>
                  </div>

                  <div class="col-6">
                     <div class="form-group">
                        <label for="selectType">Chọn loại sản phẩm</label>

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

                  <div class="col-6">
                     <div class="form-group">
                        <label for="selectBrand">Chọn thương hiệu</label>

                        <select multiple class="form-control" id="selectBrand" name="brand">

                           <?php

                              if ( count( $brand ) > 0 ) {
                                 foreach( $brand as $type ) {
                                    ?> <option value="<?php echo $type->id; ?>"><?php echo $type->brand_name; ?></option> <?php
                                 }
                              }

                            ?>
                        </select>
                     </div>
                  </div>

                  <div class="col-6">
                     <div class="form-group">
                        {{Form::label('', 'Ngày Nhập Kho')}}
                        {{Form::date('import_date', \Carbon\Carbon::now(), ['class' => 'form-control'])}}
                     </div>
                  </div>


               </div>
   					
					{{Form::submit('Đăng sản phẩm', ['name' => 'submit_product', 'class' => 'btn btn-primary'])}}

				{!! Form::close() !!}
			</div>

		</div>
	</div>

</div>

@endsection

