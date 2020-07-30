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
                <input type="hidden" value name="productsInOrder" id="pio">

                    <div class="row">
                        
                        <div class="col-8">
                        
                        <h2>Thông tin đơn xuất hàng mã {{$currentExportOrder->code}}</h2>
                        
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

                                    

                                    @foreach( $orderProducts as $key => $value )
                                        
                                        <?php $pio = $Products::find($key) ?>

                                        <tr>
                                            <td><img src="/uploaded/{{ $pio->product_image }}" alt=""></td>
                                            <td>{{ $pio->name }}</td>
                                            <td>{{ $pio->sku }}</td>
                                            <td>{{ $value }}</td>
                                        </tr>

                                        {{-- <li>{{$Products::find($value)}}</li> --}}
                                    @endforeach
                                </tbody>

                            </table>
                        </form>

                        <div class="product_info">
                            <div class="do_action">

                                @if( $currentExportOrder->status == "wait" )

                                <h4>Duyệt và vận chuyển?</h4>
                                <a href="{{ url('export/approve-order/'. $currentExportOrder->id) }}">Xác nhận</a>

                                @elseif ( $currentExportOrder->status == "approve" )
                                    
                                    <h4>Xác nhận hoàn tất?</h4>
                                    <a href="{{ url('export/confirm-order/'. $currentExportOrder->id) }}">Hoàn tất</a>

                                @else 

                                    <h4>Đơn hàng này đã hoàn tất.</h4>

                                @endif

                            </div>
                        </div>

                        </div>

                        <div class="col-4">

                            <div class="product_info">
                                <div class="status">
                                    <span class="s_label">Trạng thái:</span> 
                                    
                                    <span class="s_text float-right">
                                        @if ( $currentExportOrder->status == "wait" )
                                            Chờ duyệt
                                        @else 
                                            Đang giao
                                        @endif
                                    </span>
                                    
                                    
                                </div>

                                <div class="location">
                                    Nhập về kho <b>
                                        @if( $currentExportOrder->location == 1 )
                                            Nơ Trang Long
                                        @else 
                                            Tân Tạo
                                        @endif
                                        </b>
                                </div>

                                <div class="order_meta">
                                    <div class="each_info">
                                        Mã đơn hàng: {{ $currentExportOrder->code }}
                                    </div>
                                    <div class="each_info">
                                        Ngày hẹn giao: {{ $currentExportOrder->deadline }}
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