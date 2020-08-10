
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
            $thisProduct = $products::find($pid);
            $realProduct = $productsInStorage::find($id);
        @endphp

    <input type="hidden" value="{{$id}}" id="getPID">
		<div class="container pt-4">
			<div class="action_box d-flex align-items-center justify-content-between">
                <h2 class="main_content__title">Tạo Hạn Sử Dụng cho {{ $thisProduct->name }}</h2>
			</div>
            <form id="expirationForm">
                <table class="lotus_table">
                    <thead>
                        <tr>
                            <th><img src="/uploaded/{{$thisProduct->product_image}}" alt=""></th>
                            <th>{{ $thisProduct->name }}</th>
                            <th>Kho: @if ($location == 1) Nơ Trang Long @else Tân Tạo @endif</th>
                            <th>Tồn kho: {{ $realProduct->amount }}</th>
                        </tr>
                    </thead>
                    
                    
                        <tbody id="expirationDates">
                            @foreach($getDate as $id => $expArr)
                                @foreach ($expArr as $amount => $date)
                                    <tr>
                                        <td>Phiên bản</td>
                                        <td>Số lượng: <input type='number' class='form-control' name='expAmount' value="{{$amount}}" /></td>
                                        <td>Ngày hết hạn: <input type='date' class='form-control' name='expDate' value="{{ $date }}" /></td>
                                    </tr>   
                                @endforeach
                            
                            @endforeach
                            
                        </tbody>
                    
                </table>
            </form>
		</div>
	</div>

</div>

@endsection
