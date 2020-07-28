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

                <div class="action_box d-flex align-items-center justify-content-between">
                    <h2 class="main_content__title">Đơn hàng nhập kho</h2>
                    <a href="{{ url('') }}" class="btn btn-outline-dark">Tạo đơn xuất +</a>
                </div>

                <table class="lotus_table">
                    
                    <thead>
                        <tr>
                            <th rowspan="1" colspan="1">Mã đơn</th>
                            <th rowspan="1" colspan="1">Nơi lưu trữ</th>
                            <th rowspan="1" colspan="1">Ngày tạo đơn</th>
                            <th>Ngày hẹn giao</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>


                </table>

                
                
            </div>

        </div>

    </div>

@endsection
