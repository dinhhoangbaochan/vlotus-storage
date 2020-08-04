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

		<div class="container pt-4">
			<div class="action_box d-flex align-items-center justify-content-between">
				<h2 class="main_content__title">Quản lý Hạn Sử Dụng</h2>
				<a href="/storage/create" class="btn btn-outline-dark">Thêm HSD +</a>
			</div>

			{{ $products }}

			@foreach ($productsInStorage as $item)
				<li>{{ $item->p_id }}</li>
			@endforeach

		</div>
	</div>

</div>

@endsection
