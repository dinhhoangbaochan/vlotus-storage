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

         {!! Form::open([ 'action' => ['ProductsController@update', $products->id], 'method' => 'POST', ]) !!}
         
            <div class="row">
               
               <div class="col-8">

                  <div class="product_info">
                     
                     <div class="row">
                     
                        <div class="col-12">
                           <div class="form-label-group">
                              <input type="text" id="product_name" class="form-control" value="{{ $products->name }}" name="product_name" autofocus>
                              <label for="product_name">Sửa tên sản phẩm</label>
                           </div>
                        </div>

                        <div class="col-6">
                           <div class="form-label-group">
                              <input type="text" id="product_sku" class="form-control" value="{{ $products->sku }}" name="product_sku" autofocus>
                              <label for="product_sku">Sửa SKU sản phẩm</label>
                           </div>
                        </div>

                        <div class="col-6">
                           <div class="form-label-group">
                              <input type="text" id="product_code" class="form-control" value="{{$products->code}}" name="product_code" autofocus>
                              <label for="product_code">Sửa code sản phẩm</label>
                           </div>
                        </div>

                        <div class="col-6">
                           <div class="form-label-group">
                              <input type="number" id="product_price" class="form-control" value="{{$products->price}}" name="product_price" autofocus>
                              <label for="product_price">Chỉnh sửa giá</label>
                           </div>
                        </div>

                        <div class="col-6">
                           <div class="form-label-group">
                              <input type="text" id="unit" class="form-control" value="{{ $products->unit }}" name="unit" autofocus>
                              <label for="unit">Sửa đơn vị</label>
                           </div>
                        </div>

                        <div class="col-12">
                           @if ( $products->note ) 
                              <div class="form-label-group">
                                 <textarea name="product_note" id="product_note" rows="8" value="{{$product->note}}"></textarea>
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

                     {{Form::hidden('_method', 'PUT')}}
                     {{Form::submit('Sửa sản phẩm', ['name' => 'submit_product', 'class' => 'update_btn'])}}
                     
                     <a class="update_btn" href="">Cập nhật</a>
                     <a class="delete_btn" href="">Xoá</a>

                  </div>

                  <div class="product_info">
                     
                     <h3>Danh mục sản phẩm</h3>

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

                  </div>

                  <div class="product_info">
                     
                     <h3>Thương hiệu sản phẩm</h3>

                     <div class="product_meta">

                        @foreach( $list_brand as $brand )
                           <div class="each_el">
                              @if ( $brand->id == $products->brand )

                                 <div class="radio">
                                    <label><input type="radio" name="brand_radio" value="{{$brand->id}}" checked> {{$brand->brand_name}}</label>
                                 </div>

                              @else 

                                 <div class="radio">
                                    <label><input type="radio" value="{{$brand->id}}" name="brand_radio"> {{$brand->brand_name}}</label>
                                 </div>

                              @endif
                              
                           </div>
                        @endforeach

                     </div>

                  </div>

                  <div class="product_info">
                     <img src="../../uploaded/{{$products->product_image}}" alt="">
                  </div>

               </div>


            </div>

         {!! Form::close() !!}

			<div class="product_info">
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



			</div>

		</div>
	</div>

</div>

@endsection

<script>
</script>