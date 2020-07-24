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
                <h2>Chưa có đơn nhập hàng</h2>
            </div>

        </div>

    </div>

@endsection
