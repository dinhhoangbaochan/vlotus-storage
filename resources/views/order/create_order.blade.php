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

            <div class="main_content">
                {!! Form::open([ 'action' => 'OrderController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data' ]) !!}

                    <div class="row">
                        
                        <div class="col-8">
                            
                            <div class="product_info">
                                <div class="dropdown">
                                    <input type="text" class="w-100" id="look_for_product" name="findProducts" value="" placeholder="Nhập tên sản phẩm cần thêm vào đơn hàng">
                                    <div id="findProductList" class="dropdown-menu" aria-labelledby="">
                                        
                                    </div>
                                </div>   
                            </div>

                        </div>

                    </div>

                    

                {!! Form::close() !!}

                <div id="whereToPrint" class="selectedProduct">
                    <h2>Các sản phẩm bạn đã chọn cho đơn hàng</h2>
                    <ul>
                        <li></li>
                    </ul>
                </div>

            </div>

        </div>

    </div>
@endsection
