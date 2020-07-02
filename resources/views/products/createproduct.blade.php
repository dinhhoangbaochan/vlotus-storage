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
			<a href="" class="btn btn-danger">Huỷ</a>
			<a href="" class="btn btn-success">Trợ Giúp</a>

		</div>

		@include('inc.message')

		<div class="main_content">
			
			<a href="/products">< Quay lại danh sách sản phẩm</a>
			<h2 class="main_content__title">Nhập sản phẩm mới</h2>

			<div class="product_info">
				{!! Form::open([ 'action' => 'ProductsController@store', 'method' => 'POST', ]) !!}

               <div class="row">
                  
                  <div class="col-6">
                     <div class="form-group">
                        {{Form::label('', 'Tên sản phẩm')}}
                        {{Form::text('product_name','', ['placeholder' => 'Product Name', 'class' => 'form-control test'] )}}
                     </div>
                  </div>

               </div>

   					

   					<div class="form-group">
   						{{Form::label('', 'Mã sản phẩm (SKU)')}}
   						{{Form::text('product_sku','', ['placeholder' => 'Mã SKU'] )}}
   					</div>

   					<div class="form-group">
   						{{Form::label('', 'Mã báo cáo')}}
   						{{Form::text('product_code','', ['placeholder' => 'Mã báo cáo'] )}}
   					</div>

   					<div class="form-group">
   						{{Form::label('', 'Giá tiền')}}
   						{{Form::text('product_price','', ['placeholder' => 'Giá tiền'] )}}
   					</div>

					<div class="form-group">
   						{{Form::label('', 'Số lượng')}}
   						{{Form::text('amount','', ['placeholder' => 'Số lượng'] )}}
   					</div>

   					<div class="form-group">
   						{{Form::label('', 'Đơn vị')}}
   						{{Form::text('unit','', ['placeholder' => 'Đơn vị'] )}}
   					</div>

   					<div class="form-group">
   						{{Form::label('', 'Trạng Thái')}}
   						{{Form::select('status', [
   							'on-deliver' 	=> 'Đang Giao Hàng', 
   							'left' 			=> 'Tồn Kho', 
   							'completed' 	=> 'Hoàn Tất',
   							'in-payment'	=> 'Chờ Thanh Toán',
   							], 'on-deliver')}}
   					</div>

   					{{Form::submit('Đăng sản phẩm', ['name' => 'submit_product'])}}

				{!! Form::close() !!}
			</div>

		</div>
	</div>

</div>

@endsection

