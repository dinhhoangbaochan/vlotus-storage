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
				<a href="#createStaff" data-toggle="modal" class="btn btn-outline-dark">Thêm User +</a>
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

<div class="modal fade" id="createStaff" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		{!! Form::open([ 'action' => ['UsersController@createStaff'], 'method' => 'POST', ]) !!}
			@csrf
	  <div class="modal-content">
		<div class="modal-header">
			
		  <h5 class="modal-title" id="exampleModalLabel">Tạo nhân viên mới</h5>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body">
			
			<div class="form-group row">
				<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Địa chỉ Email') }}</label>

				<div class="col-md-6">
					<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email" autofocus>

					@error('email')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
			</div>

			<div class="form-group row">
				<label for="staff_name" class="col-md-4 col-form-label text-md-right">{{ __('Tên nhân viên') }}</label>

				<div class="col-md-6">
					<input id="staff_name" type="text" class="form-control @error('staff_name') is-invalid @enderror" name="staff_name" required>

					@error('staff_name')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
			</div>

			<div class="form-group row">
				<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mật Khẩu') }}</label>

				<div class="col-md-6">
					<input id="password" type="password" class="form-control @error('staff_name') is-invalid @enderror" name="password" required>

					@error('password')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
			</div>
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
		  <button type="submit" class="btn btn-primary">Tạo nhân viên</button>
		</div>
	  </div>
	</form>
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

