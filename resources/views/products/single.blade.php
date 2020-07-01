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
		<div class="main_content">
			
			<a href="/products" class="return_url">< Quay lại danh sách sản phẩm</a>
			<h2 class="main_content__title">{{ $products->product_name }}</h2>

			<div class="product_info">
				<form action="" method="post">
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label for="">Tên sản phẩm</label>
								<input type="text" name="product_name" class="form-control" value="{{$products->product_name}}">
							</div>	
						</div>

						<div class="col-6">
							<div class="form-group">
								<label for="">Mã sản phẩm(SKU)</label>
								<input type="text" class="form-control" name="product_sku" value="{{$products->product_sku}}">
							</div>
						</div>

						<div class="col-6">
							<div class="form-group">
								<label for="">Mã Báo Cáo</label>
								<input type="text" class="form-control" name="product_code" value="{{$products->product_code}}">
							</div>
						</div>

					</div>

					<div class="row">
						<div class="col-6">
							<div class="form-group">
								<label for="">Giá</label>
								<input type="text" class="form-control" name="product_price" value="{{$products->product_price}}">
							</div>	
						</div>
					</div>

					<div class="row">

						<div class="col-6">
							<div class="form-group">
								<label for="">Số lượng</label>
								<input type="text" class="form-control" name="amount" value="{{$products->amount}}">
							</div>
						</div>
					</div>
					
					
				</form>
				<hr>
				<a href="" class="btn btn-primary">Sửa Sản Phẩm</a>
			</div>

		</div>
	</div>

</div>

@endsection

