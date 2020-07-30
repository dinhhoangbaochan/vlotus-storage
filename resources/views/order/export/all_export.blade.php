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
                    <a data-toggle="modal" data-target="#selectLocation" class="btn btn-outline-dark">Tạo đơn xuất +</a>
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


                    <tbody>
                        @if( count( $exportOrder ) > 0 )

                            @foreach( $exportOrder as $export )
                                <tr>
                                    <td><a href="/export/{{$export->id}}">{{$export->code}}</a></td>
                                    <td>
                                        @if ( $export->location == 1 )
                                            Kho Nơ Trang Long
                                        @else 
                                            Kho Tân Tạo
                                        @endif
                                    </td>
                                    <td>{{ $export->created_at }}</td>
                                    <td>{{ $export->deadline }}</td>
                                    <td>
                                        @if ( $export->status == "wait" ) 
                                            Chờ duyệt
                                        @else 
                                            Đã duyệt
                                        @endif
                                    </td>
                                </tr>
                            @endforeach 
                        @else 
                            <h2>Chưa có đơn nhập hàng</h2>
                        @endif    
                    </tbody>


                </table>

                
                
            </div>

        </div>

    </div>

<!-- Modal -->
<div class="modal fade" id="selectLocation" tabindex="-1" role="dialog" aria-labelledby="selectLocation" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<a href={{ url('orders/create-export/location_1') }}>Kho Nơ Trang Long</a>
				<a href="{{ url('orders/create-export/location_2') }}">Kho Tân Tạo</a>
			</div>
		</div>
	</div>
</div>


@endsection
