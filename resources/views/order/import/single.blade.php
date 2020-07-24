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
                <input type="hidden" value name="productsInOrder" id="pio">

                    <div class="row">
                        
                        <div class="col-8">
                        
                        <h2>Thông tin đơn hàng mã {{$currentImportOrder->code}}</h2>
                        
                        <form id="formTwo">
                            <table class="lotus_table">
                                <thead>
                                    <tr>
                                        <th rowspan="1" colspan="1" style="width:100px">Image</th>
                                        <th rowspan="1" colspan="1">Sản phẩm</th>
                                        <th rospan="1" colspan="1">SKU</th>
                                        <th rowspan="1" colspan="1">Số lượng</th>
                                    </tr>
                                </thead>

                                <tbody class="LT_body">

                                    

                                    @foreach( $orderProducts as $value )
                                        
                                        <?php $pio = $Products::find($value) ?>

                                        <tr>
                                            <td><img src="/uploaded/{{ $pio->product_image }}" alt=""></td>
                                            <td>{{ $pio->name }}</td>
                                            <td>{{ $pio->sku }}</td>
                                            <td>{{ $pio->tmp_imp }}</td>
                                        </tr>

                                        {{-- <li>{{$Products::find($value)}}</li> --}}
                                    @endforeach
                                </tbody>

                            </table>
                        </form>

                        <div class="product_info">
                            <div class="do_action">
                                <h4>Duyệt và vận chuyển?</h4>
                                <input type="button" value="Xác Nhận">
                            </div>
                        </div>

                        </div>

                        <div class="col-4">

                            <div class="product_info">
                                <div class="status">
                                    <span class="s_label">Trạng thái:</span> 
                                    
                                    <span class="s_text float-right">
                                        @if ( $currentImportOrder->status == "wait" )
                                            Chờ duyệt
                                        @else 
                                            Đang giao
                                        @endif
                                    </span>
                                    
                                    
                                </div>

                                <div class="location">
                                    Nhập về kho <b>
                                        @if( $currentImportOrder->location == 1 )
                                            Nơ Trang Long
                                        @else 
                                            Tân Tạo
                                        @endif
                                        </b>
                                </div>

                                <div class="order_meta">
                                    <div class="each_info">
                                        Mã đơn hàng: {{ $currentImportOrder->code }}
                                    </div>
                                    <div class="each_info">
                                        Ngày hẹn giao: {{ $currentImportOrder->deadline }}
                                    </div>
                                    <div class="each_info">
                                        Nhân viên tạo đơn: Đinh Hoàng Bảo Chấn
                                    </div>
                                </div>
                            </div>

                            <div class="product_info">
                                <div class="each_info">
                                    <h4>Ghi chú</h4>
                                    <p>Không có</p>
                                </div>
                            </div>

                        </div>
    


                    </div>

                    

                

            </div>

        </div>

    </div>
@endsection
