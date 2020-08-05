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
				<a href="{{url('expiration')}}" class="btn btn-outline-dark">Thêm HSD +</a>
			</div>

			<table class="lotus_table">
                    
				<thead>
					<tr>
						<th>Hình ảnh</th>
						<th>Tên sản phẩm</th>
						<th>Nơi lưu trữ</th>
					</tr>
				</thead>

				@if ( count( $expiration ) > 0 )

					<tbody>
						
						@foreach ($expiration as $item)
							@php $currentProducts = $products::find( $item->p_id ) @endphp
							<tr>
								<td>{{ $currentProducts->product_image }}</td>
								<td><a href="/expiration/edit/p_id={{ $item->p_id }}/location={{ $item->location }}/id={{ $item->id }}">{{ $currentProducts->name }}</a></td>
								<td> @if ($item->location == 1) Nơ Trang Long @else Tân Tạo @endif</td>
							</tr>
						@endforeach
						
					</tbody>

				@else
					<tbody>
						<p>Chưa có hạn sử dụng</p>
					</tbody>
				@endif

				

			</table>

		</div>
	</div>

</div>

@endsection