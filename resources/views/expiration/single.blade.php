{{-- 
    
    ID and Location that we have here, is NOT the ID from products table. 
    It's from the products_in_storage table. 

    - ID is p_id
    
--}}

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
        
        @php
            $thisProduct = $products::find($id);
        @endphp

		<div class="container pt-4">
			<div class="action_box d-flex align-items-center justify-content-between">
            <h2 class="main_content__title">Tạo Hạn Sử Dụng cho {{ $thisProduct->name }}</h2>
			</div>
            

		</div>
	</div>

</div>

@endsection
