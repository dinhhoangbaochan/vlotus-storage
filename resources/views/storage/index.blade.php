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

		<div class="container pt-4">
			<div class="action_box d-flex align-items-center justify-content-between">
				<h2 class="main_content__title">Danh sách kho</h2>
				<a href="/storage/create" class="btn btn-outline-dark">Thêm kho +</a>
			</div>

			<div class="row justify-content-center">
				@if ( count($storage) )

					@foreach ( $storage as $value )
						<div class="col-4">
							<div class="storage_info">
								<span class="material-icons">unarchive</span>
								<h3><a href="storage/{{$value->id}}">{{ $value->location }}</a></h3>
							</div>
						</div>
					@endforeach

					
				@else 
					<p>Chưa tạo kho</p>
				@endif
			</div>

		</div>
	</div>

</div>

@endsection

<style>
	
.storage_info {
    background-color: #fff;
    box-shadow: 2px 3px 6px #c7c7c79e;
    padding: 40px 10px;
    text-align: center;
    border-radius: 8px;
}

.storage_info h3 {
    margin: 0;
    font-size: 24px;
    font-weight: 800;
    text-transform: capitalize;
}

.storage_info .material-icons {
    font-size: 40px;
    color: #b80000;
    margin-bottom: 1rem;
}

</style>