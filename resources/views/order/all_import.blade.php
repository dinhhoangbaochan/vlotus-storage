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
                    <a href="/orders/create-import" class="btn btn-outline-dark">Tạo đơn nhập +</a>
                </div>

                <ul>

                @if( count( $importOrder ) > 0 )

                    @foreach( $importOrder as $import )
                        <li>{{ $import->code }}</li>
                    @endforeach 
                @else 
                    <h2>Chưa có đơn nhập hàng</h2>
                @endif

                </ul>
                
            </div>

        </div>

    </div>

@endsection
