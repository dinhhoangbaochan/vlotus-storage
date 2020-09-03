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
			
			<a href="{{url('products')}}" class="return_url">< Quay lại danh sách sản phẩm</a>
			<h2 class="main_content__title">Thông tin sản phẩm</h2>

         {!! Form::open([ 'action' => ['ProductsController@update', $products->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
         
            <div class="row">
               
               <div class="col-8">

                  <div class="product_info">
                     
                     <div class="row">
                     
                        <div class="col-12">
                           <div class="form-label-group">
                              <input type="text" id="product_name" class="form-control" value="{{ $products->name }}" name="product_name" autofocus>
                              <label for="product_name">Tên sản phẩm</label>
                           </div>
                        </div>

                        <div class="col-4">
                           <div class="form-label-group">
                              <input type="text" id="product_sku" class="form-control" value="{{ $products->sku }}" name="product_sku" autofocus>
                              <label for="product_sku">Mã sản phẩm (mã kho)</label>
                           </div>
                        </div>

                        <div class="col-4">
                           <div class="form-label-group">
                              <input type="text" id="product_code" class="form-control" value="{{$products->code}}" name="product_code" autofocus>
                              <label for="product_code">Mã sản phẩm (mã kế toán)</label>
                           </div>
                        </div>

                        <div class="col-4">
                           <div class="form-label-group">
                              <select name="unit" id="" class="form-control" style="padding: var(--input-padding-y) var(--input-padding-x)">
                                 <option value="">Hộp</option>
                                 <option value="">Chai</option>
                                 <option value="">Thùng</option>
                              </select>
                           </div>
                        </div>

                        <div class="col-12">
                           @if ( $products->note ) 
                              <div class="form-label-group">
                                 <textarea name="product_note" id="product_note" rows="8" value="{{$products->note}}"></textarea>
                              </div>
                           @else 
                              <div class="form-label-group">
                                 <textarea name="product_note" id="product_note" rows="8" placeholder="Cập nhật ghi chú"></textarea>
                              </div>
                           @endif
                        </div>

                     </div>

                  </div>
                  
                  
               </div>



               <div class="col-4">
                  
                  <div class="product_info d-flex justify-content-around">

                     
                     {{-- {{Form::submit('Sửa sản phẩm', ['name' => 'submit_product', 'class' => 'update_btn'])}} --}}
                     {{Form::hidden('_method', 'PUT')}}
                     <button type="submit" class="update_btn">Cập nhật</button>
                     <a class="delete_btn" data-toggle="modal" href="#delete_modal">Xoá</a>


                  </div>

                  <div class="product_info">

                     <label for="selectBrand" class="title-label">Chỉnh sửa danh mục</label>

                     <div class="product_meta">

                        <input type="hidden" id="current_cate" name="current_cate" value="{{ $products->cate }}">

                        @foreach( $list_cat as $cat )
                           <div class="each_el">
                              @if ( $cat->id == $products->cate )

                                 <div class="radio">
                                    <label><input type="radio" name="cate_radio" value="{{$cat->id}}" checked> {{$cat->cate_name}}</label>
                                 </div>

                              @else 

                                 <div class="radio">
                                    <label><input type="radio" value="{{$cat->id}}" name="cate_radio"> {{$cat->cate_name}}</label>
                                 </div>

                              @endif
                              
                           </div>
                        @endforeach

                     </div>

                     <div class="gap-1"></div>


                  </div>


               <div class="product_info text-center">
                  <input type="file" placeholder="Upload" class="upload_img" name="product_thumbnail">
                  <img src="../../uploaded/{{$products->product_image}}" class="img_preview">
               </div>

               </div>


            </div>

         {!! Form::close() !!}


         <!-- Delete Modal -->
         <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="delete_modal" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">

                  {!! Form::open( ['action' => ['ProductsController@destroy', $products->id], 'method' => 'POST', 'class' => 'm-0']) !!}
                  
               
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Alert!!!</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     Bạn có chắc muốn xóa sản phẩm này? Hành động này không thể khôi phục.
                  </div>
                  <div class="modal-footer">
                     {{ Form::hidden('_method', 'DELETE') }}
                  {{ Form::submit('Xoá sản phẩm', ['class' => 'btn btn-danger']) }}  
                  </div>
                  {!! Form::close() !!}
               </div>
            </div>
         </div>

			{{-- <div class="product_info">
				{!! Form::open([ 'action' => ['ProductsController@update', $products->id], 'method' => 'POST', ]) !!}

               <div class="row">
                  
                  <div class="col-12">
                     <div class="form-group">
                        {{Form::label('', 'Tên sản phẩm')}}
                        {{Form::text('product_name', $products->product_name, ['class' => 'form-control'] )}}
                     </div>
                  </div>

                  <div class="col-6">
                     <div class="form-group">
                        {{Form::label('', 'Mã sản phẩm (SKU)')}}
                        {{Form::text('product_sku', $products->product_sku, ['class' => 'form-control'] )}}
                     </div>
                  </div>

                  <div class="col-6">
                     <div class="form-group">
                        {{Form::label('', 'Mã báo cáo')}}
                        {{Form::text('product_code', $products->product_code, ['class' => 'form-control'] )}}
                     </div>
                  </div>

                  <div class="col-6">
                     <div class="form-group">
                        {{Form::label('', 'Giá tiền')}}
                        {{Form::text('product_price', $products->product_price, ['class' => 'form-control'] )}}
                     </div>
                  </div>

                  <div class="col-6">
                     <div class="form-group">
                        {{Form::label('', 'Số lượng')}}
                        {{Form::number('amount', $products->amount, ['class' => 'form-control', 'data-type' => 'currency'] )}}
                     </div>
                  </div>

                  <div class="col-6">
                     <div class="form-group">
                        {{Form::label('', 'Đơn vị')}}
                        {{Form::text('unit', $products->unit, ['class' => 'form-control'] )}}
                     </div>
                  </div>

                  <div class="col-6">
                     <div class="form-group">
                        {{Form::label('', 'Trạng Thái')}}
                        {{Form::select('status', [
                           'on-deliver'   => 'Đang Giao Hàng', 
                           'left'         => 'Tồn Kho', 
                           'completed'    => 'Hoàn Tất',
                           'in-payment'   => 'Chờ Thanh Toán',
                           ], $products->status, ['class' => 'form-control'])}}
                     </div>
                  </div>

                  <div class="col-6">
                     <div class="form-group">

                        {{Form::label('', 'Loại Sản Phẩm')}}
                        {{Form::select('type', $list_cat, $products->type, ['class' => 'form-control'])}}
                     </div>
                  </div>

                  <div class="col-6">
                     <div class="form-group">

                        {{Form::label('', 'Ngày Nhập Kho')}}
                        {{Form::date('name', \Carbon\Carbon::now(), ['class' => 'form-control'])}}
                     </div>
                  </div>

               </div>
   					
   					{{Form::hidden('_method', 'PUT')}}
					{{Form::submit('Sửa sản phẩm', ['name' => 'submit_product', 'class' => 'btn btn-primary'])}}

				{!! Form::close() !!}

				{!! Form::open( ['action' => ['ProductsController@destroy', $products->id], 'method' => 'POST']) !!}
               {{ Form::hidden('_method', 'DELETE') }}
					{{ Form::submit('Xoá sản phẩm', ['class' => 'btn btn-danger']) }}  
				{!! Form::close() !!}



			</div> --}}

		</div>
	</div>

</div>

@endsection

<script>
</script>