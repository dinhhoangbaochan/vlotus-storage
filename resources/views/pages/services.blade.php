@extends('layout.app')

	@section('content')

		<h1>{{ $title }}</h1>

		<div class="">
			<ul>
				@if(count($list) > 0)
					@foreach($list as $service)
						<li>{{$service}}</li>
					@endforeach
				@endif
			</ul>
			
		</div>

	@endsection