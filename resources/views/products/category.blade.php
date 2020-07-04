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
			
			<h2 class="main_content__title">Danh sách danh mục sản phẩm</h2>	

			<div class="row">
				<div class="col-4">
					{!! Form::open([ 'action' => 'ProductCategoryController@store', 'method' => 'POST', ]) !!}
						{{Form::label('', 'Danh mục sản phẩm')}}
					    {{Form::text('category_name', '', ['class' => 'form-control', 'placeholder' => 'Nhập danh mục sản phẩm']) }}
						{{Form::submit('Tạo danh mục')}}
					{!! Form::close() !!}
				</div>
				<div class="col-8">
					<?php 

						if( count($category_list) > 0 ) {
							foreach( $category_list as $cat ) {
								?>
									<ul>
										<li><?php echo $cat->cate_name; ?></li>
										<div class="">
											<a href="" data-toggle="modal" data-target="#edit_category_<?php echo $cat->id; ?>">Sửa</a>
											<a href="{{URL::to('product-category/delete/' . $cat->id)}}">Xoá</a>
										</div>
									</ul>


									<!-- Modal -->
									<div class="modal fade" id="edit_category_<?php echo $cat->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

										<div class="modal-dialog" role="document">

											<div class="modal-content">

												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
													</button>
												</div>

												<div class="modal-body">
													
													{!! Form::open([ 'action' => ['ProductCategoryController@update', $cat->id], 'method' => 'POST', ]) !!}
														{{ Form::text('cate_name', $cat->cate_name ) }}
														{{Form::hidden('_method', 'PUT')}}
														{{Form::submit('Sửa danh mục', ['class' => 'btn btn-primary'])}}
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
						} else {
							echo '<span>Không có danh mục</span>';
						}

					?>
				</div>
			</div>

		</div>
	</div>

</div>



@endsection

	