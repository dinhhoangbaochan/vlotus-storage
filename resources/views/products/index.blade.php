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
				<h2 class="main_content__title">Danh sách sản phẩm</h2>
				<a href="/products/create" class="btn btn-outline-dark">Thêm sản phẩm +</a>
			</div>
			<table class="lotus_table">
				<thead>
					<tr>
						<th rowspan="1" colspan="1" style="width:100px">Image</th>
						<th rowspan="1" colspan="1">Sản phẩm</th>
						<th rowspan="1" colspan="1">SKU</th>
						<th rowspan="1" colspan="1">Mã Report</th>
						<th rowspan="1" colspan="1">Ngày nhập</th>
						<th rowspan="1" colspan="1">Đơn vị</th>
					</tr>
				</thead>

				<tbody>

					@if( count($products) > 0 )
						@foreach ( $products as $product )
							<tr>
								<td style="text-align: center;">

									@if ( $product->product_image )
										<img src="/uploaded/{{ $product->product_image }}" alt="">
									@else 
										<img src="/uploaded/noimage.png" alt="">
									@endif
									
								</td>
								<td><a href="/products/{{$product->id}}/edit">{{ $product->name }}</a></td>
								<td><span>{{ $product->sku }}</span></td>
								<td><span>{{ $product->code }}</span></td>
								<td><span>{{ $product->import_date }}</span></td>
								<td><span>{{ $product->unit }}</span></td>
{{-- 								<td><span>
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
								</span></td> --}}
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