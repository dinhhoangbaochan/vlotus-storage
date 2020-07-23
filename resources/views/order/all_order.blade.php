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
                <h1>List of All Orders</h1>
                <ul>
                @if( count($order) > 0 )

                    @foreach( $order as $value ) 
                     <li>Mã: {{ $value->code }}</li>   
                    @endforeach

                @else 

                @endif
                </ul>
            </div>

        </div>

    </div>

@endsection
