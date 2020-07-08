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
									<td>
										<a href="/users/delete/<?php echo $user->id; ?>">Xoá</a> 
										<a href="" data-toggle="modal" data-target="#edit_user_<?php echo $user->id; ?>">Sửa</a>
									</td>
								</tr>
								
								<!-- Modal -->
								<div class="modal fade" id="edit_user_<?php echo $user->id; ?>" tabindex="-1" role="dialog">

									<div class="modal-dialog" role="document">

										<div class="modal-content">

											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
												</button>
											</div>

											<div class="modal-body">
												
												{!! Form::open([ 'action' => ['UsersController@update', $user->id], 'method' => 'POST', ]) !!}

													<div class="form-group row">
														<div class="col-6">
															{{Form::label('name', 'Tên Nhân Viên', ['class' => 'awesome'])}}
															{{Form::text('user_name', $user->name, ['class' => 'form-control'])}}
														</div>
														<div class="col-6">
															{{Form::label('email', 'Email Nhân Viên', ['class' => 'awesome'])}}
															{{Form::text('email', $user->email, ['class' => 'form-control'])}}
														</div>
														
													</div>

													
													{{Form::hidden('_method', 'PUT')}}
													{{Form::submit('Sửa user', ['class' => 'btn btn-primary'])}}
												{!! Form::close() !!}
												

											</div>

											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											</div>

										</div>

									</div>

								</div>


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

