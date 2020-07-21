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

			
		<a href="/products" class="return_url">< Quay lại danh sách sản phẩm</a>
		<h2 class="main_content__title">Nhập sản phẩm mới</h2>
         
         {!! Form::open([ 'action' => 'StorageController@store', 'method' => 'POST' ]) !!}

			<div class="row">
		
				<input type="text" name="location">
				<input type="submit" value="Tạo kho">		

			</div>

         {!! Form::close() !!}


		</div>
	</div>

</div>

@endsection


