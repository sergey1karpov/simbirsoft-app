@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center text-center">
		<div class="col-8">
			<h5 class="display-4">Cities</h5>
			<ul class="list-group list-group-flush">
				@foreach($cities as $city)
					<a href="{{ route('sCity', ['city' => $city->slug]) }}">
						<li class="list-group-item">{{$city->name}}</li>
					</a>
				@endforeach
			</ul>
		</div>
	</div>
</div>
@endsection