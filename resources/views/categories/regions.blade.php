@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center text-center">
		<div class="col-8">
			<h5 class="display-4">Regions</h5>
			<ul class="list-group list-group-flush">
				@foreach($regions as $reg)
					<a href="{{ route('cities', ['region' => $reg->slug]) }}">
						<li class="list-group-item">{{$reg->name}}</li>
					</a>
				@endforeach
			</ul>
		</div>
	</div>
</div>
@endsection