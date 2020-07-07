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
				<h2 class="main_content__title">Danh sách Users</h2>
				<a href="/register" class="btn btn-outline-dark">Thêm User +</a>
			</div>

			<div class="row">
				<div class="col-12">

				<table class="lotus_table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Tên người dùng</th>
							<th>Email</th>
							<th>Thời gian tạo</th>
							<th>Hành động</th>
						</tr>
					</thead>

					<tbody>
					<?php 

						if( count($users) > 0 ) {
							foreach( $users as $user ) {
								?>
								
								<tr>
									<td><?php echo $user->id; ?></td>
									<td><?php echo $user->name; ?></td>
									<td><?php echo $user->email; ?></td>
									<td><?php echo $user->created_at; ?></td>
									<td><a href="">Xoá</a> <a href="">Sửa</a></td>
								</tr>

								<?php 
							}
						} else {
							echo '<span>Không có danh mục</span>';
						}

					?>
					</tbody>

				</table>



				</div>
			</div>

		</div>
	</div>

</div>



@endsection

	

{{-- @extends('layouts.app')

@section('content')
    
    <div class="row m-0">
        
        <div class="col-2 p-0">
            <div class="left_sidebar">
                @include('inc.sidebar')
            </div>
        </div>

        <div class="col-10 p-0">

            @include('inc.navbar')

            <div class="main_content">
                @if( count($users) > 0 )
					
					@foreach( $users as $user ) 
						{{ $user->name }}
					@endforeach

				@endif
            </div>

        </div>

    </div>

@endsection
 --}}

