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
			
			<h2 class="main_content__title">Danh sách thương hiệu</h2>	

			<div class="row">
				<div class="col-4">
					{!! Form::open([ 'action' => 'ProductBrandController@store', 'method' => 'POST', ]) !!}
						{{Form::label('', 'Thương hiệu sản phẩm')}}
					    {{Form::text('category_name', '', ['class' => 'form-control', 'placeholder' => 'Nhập thương hiệu sản phẩm']) }}
						{{Form::submit('Tạo thương hiệu')}}
					{!! Form::close() !!}
				</div>
				<div class="col-8">
				</div>
			</div>

		</div>
	</div>

</div>



@endsection

	