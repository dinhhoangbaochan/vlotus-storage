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
                    <h2 class="main_content__title">{{ $storage->location }}</h2>
                </div>

                <table class="lotus_table">
                    
                    <thead>
                        <tr>
                            <th rowspan="1" colspan="1">Tên sản phẩm</th>
                            <th rowspan="1" colspan="1">Nơi lưu trữ</th>
                            <th rowspan="1" colspan="1">Số lượng chờ nhập</th>
                            <th>Số lượng chờ xuất</th>
                            <th>Số lượng tồn kho</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if( count( $productsInStorage ) > 0 )

                            @foreach( $productsInStorage as $p )
                                <tr>
                                    <td>{{ $product::find($p->p_id)->name }}</td>
                                    <td>
                                    	@if( $p->location == 1 )
                                    		Kho Nơ Trang Long
                                    	@else 
                                    		Kho Tân Tạo
                                    	@endif
                                    </td>
                                    <td>
										@if ( $p->tmp_imp === null )
											Không có
										@else 
											{{ $p->tmp_imp }}
										@endif
                                    </td>
                                    <td>
										@if ( $p->tmp_exp === null )
											Không có
										@else 
											{{ $p->tmp_exp }}
										@endif
                                    </td>
                                    <td>{{ $p->amount }}</td>
                                </tr>
                            @endforeach 
                        @else 
                            <h2>Kho còn trống</h2>
                        @endif    
                    </tbody>

                </table>

                
                
            </div>

        </div>

    </div>

@endsection
