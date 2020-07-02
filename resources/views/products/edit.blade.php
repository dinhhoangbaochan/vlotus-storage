@extends('layout.app')


@section('content')
<div class="row m-0">
	
	<div class="col-2 p-0">
		<div class="left_sidebar">
			@include('inc.sidebar')
		</div>
	</div>

	<div class="col-10 p-0">

		<div class="top_bar">
			<a href="" class="btn btn-primary">Lưu</a>
			<a href="/products" class="btn btn-danger">Huỷ</a>
			<a href="" class="btn btn-success">Trợ Giúp</a>

		</div>

		@include('inc.message')

		<div class="main_content">
			
			<a href="/products">< Quay lại danh sách sản phẩm</a>
			<h2 class="main_content__title">Nhập sản phẩm mới</h2>

			<div class="product_info">
				{!! Form::open([ 'action' => ['ProductsController@update', $products->id], 'method' => 'POST', ]) !!}

               <div class="row">
                  
                  <div class="col-12">
                     <div class="form-group">
                        {{Form::label('', 'Tên sản phẩm')}}
                        {{Form::text('product_name', $products->product_name, ['class' => 'form-control'] )}}
                     </div>
                  </div>

                  <div class="col-6">
                     <div class="form-group">
                        {{Form::label('', 'Mã sản phẩm (SKU)')}}
                        {{Form::text('product_sku', $products->product_sku, ['class' => 'form-control'] )}}
                     </div>
                  </div>

                  <div class="col-6">
                     <div class="form-group">
                        {{Form::label('', 'Mã báo cáo')}}
                        {{Form::text('product_code', $products->product_code, ['class' => 'form-control'] )}}
                     </div>
                  </div>

                  <div class="col-6">
                     <div class="form-group">
                        {{Form::label('', 'Giá tiền')}}
                        {{Form::text('product_price', $products->product_price, ['class' => 'form-control'] )}}
                     </div>
                  </div>

                  <div class="col-6">
                     <div class="form-group">
                        {{Form::label('', 'Số lượng')}}
                        {{Form::text('amount', $products->amount, ['class' => 'form-control'] )}}
                     </div>
                  </div>

                  <div class="col-6">
                     <div class="form-group">
                        {{Form::label('', 'Đơn vị')}}
                        {{Form::text('unit', $products->unit, ['class' => 'form-control'] )}}
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
                           ], $products->status, ['class' => 'form-control'])}}
                     </div>
                  </div>

               </div>
   					
   					{{Form::hidden('_method', 'PUT')}}
					{{Form::submit('Sửa sản phẩm', ['name' => 'submit_product', 'class' => 'btn btn-primary'])}}

				{!! Form::close() !!}
			</div>

		</div>
	</div>

</div>

@endsection

