@role('super admin')

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
			
			<h2 class="main_content__title">Danh sách thương hiệu</h2>	

			<div class="row">
				<div class="col-4">
					{!! Form::open([ 'action' => 'ProductBrandController@store', 'method' => 'POST', ]) !!}
						{{Form::label('', 'Thương hiệu sản phẩm')}}
					    {{Form::text('brand_name', '', ['class' => 'form-control', 'placeholder' => 'Nhập thương hiệu sản phẩm']) }}
						{{Form::submit('Tạo thương hiệu')}}
					{!! Form::close() !!}
				</div>
				<div class="col-8">

					<?php 
						if ( count($brand_list) > 0 ) {
							foreach( $brand_list as $brand ) {
								?>
									<ul>
										<li><?php echo $brand->brand_name; ?></li>
										<div class="">
											<a href="" data-toggle="modal" data-target="#edit_brand_<?php echo $brand->id; ?>">Sửa</a>
											<a href="{{URL::to('product-brand/delete/' . $brand->id)}}">Xoá</a>
										</div>
									</ul>

									<!-- Modal -->
									<div class="modal fade" id="edit_brand_<?php echo $brand->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

										<div class="modal-dialog" role="document">

											<div class="modal-content">

												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
													</button>
												</div>

												<div class="modal-body">
													
													{!! Form::open([ 'action' => ['ProductBrandController@update', $brand->id], 'method' => 'POST', ]) !!}
														{{ Form::text('brand_name', $brand->brand_name ) }}
														{{Form::hidden('_method', 'PUT')}}
														{{Form::submit('Sửa thương hiệu', ['class' => 'btn btn-primary'])}}
													{!! Form::close() !!}
													

												</div>

												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
													<button type="button" class="btn btn-primary">Save changes</button>
												</div>

											</div>

										</div>

									</div>

								<?php
							}
						}
					?>

				</div>
			</div>

		</div>
	</div>

</div>



@endsection

@else

<h2 class="text-center">You're not allowed to visit this page.</h2>

@endrole
	