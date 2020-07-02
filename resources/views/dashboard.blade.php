@extends('layouts.app')

@section('content')
    
    <div class="row m-0">
        
        <div class="col-2 p-0">
            <div class="left_sidebar">
                @include('inc.sidebar')
            </div>
        </div>

        <div class="col-10 p-0">

            <div class="top_bar">
                <a href="/products" class="btn btn-danger">Huỷ</a>
                <a href="" class="btn btn-success">Trợ Giúp</a>
            </div>

            <div class="main_content">
                
            </div>

        </div>

    </div>

@endsection
