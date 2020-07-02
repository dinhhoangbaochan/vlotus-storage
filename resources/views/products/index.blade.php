@extends('layout.app')


@section('content')
<div class="row m-0">
	
	<div class="col-2 p-0">
		<div class="left_sidebar">
			@include('inc.sidebar')
		</div>
	</div>

	<div class="col-10 p-0">

		@include('inc.message')

		<div class="container pt-4">
			<div class="action_box d-flex align-items-center justify-content-between">
				<h2 class="main_content__title">Danh sách sản phẩm</h2>
				<a href="/products/create" class="btn btn-outline-dark">Thêm sản phẩm +</a>
			</div>
			<table class="lotus_table">
				<thead>
					<tr>
						<th>Image</th>
						<th>Sản phẩm</th>
						<th>SKU</th>
						<th>Tồn Kho</th>
						<th>Trạng thái</th>
					</tr>
				</thead>

				<tbody>

					@if( count($products) > 0 )
						@foreach ( $products as $product )
							<tr>
								<td>Null</td>
								<td><a href="/products/{{$product->id}}/edit">{{ $product->product_name }}</a></td>
								<td><span>{{ $product->product_sku }}</span></td>
								<td><span>{{ $product->amount }}</span></td>
								<td><span>
									@switch( $product->status )
										@case('on-deliver')
											{{ 'Đang Giao Hàng' }}
											@break

										@case('left')
											{{ 'Tồn Kho' }}
											@break

										@case('completed')
											{{ 'Hoàn Tất' }}
											@break

										@case('in-payment')
											{{ 'Chờ Thanh Toán' }}
											@break
									@endswitch
								</span></td>
							</tr>
						@endforeach	

						{{-- Pagination --}}
						{{$products->links()}}		
					@else 
						<p>Không tìm thấy sản phẩm.</p>
					@endif	

					<tr>
						<td></td>
					</tr>
				</tbody>

			</table>


		</div>
	</div>

</div>

@endsection