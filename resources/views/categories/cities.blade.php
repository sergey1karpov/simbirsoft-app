@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row text-center">

		<div class="col-3">
			<ul class="list-group list-group-flush">
				@foreach($cities as $city)
					<a href="{{ route('sCity', ['region' => $city->region_slug, 'city' => $city->slug]) }}">
						<li class="list-group-item">{{$city->name}}</li>
					</a>
				@endforeach
			</ul>
		</div>
		<div class="col-9">
			<div class="alert alert-success">
				<h4>All ads in {{$reg->name}}</h4>
			</div>
			<div class="row">
				@foreach($ads as $ad)
					<div class="col-4">
						<div class="card shadow-sm">
			                <a href="#" style="text-decoration: none; color:black;">
			                <div class="">
			                    <div style="height:200px; background-size: cover; background-image: url({{$ad->photo}})"></div>
			                    <a href="{{ route('sSlug', ['slug' => $ad->slug]) }}">
			                        <h5 class="ml-1 card-text">{{$ad->title}}</h5>
			                    </a>
			                    <h6 class="ml-1 card-text">{{$ad->price}} rubles</h6>
			                    <h6 class="ml-1 card-text">Located: {{$ad->city_slug}}</h6>
			                    <small class="ml-1">publiched: {{$ad->created_at}}</small>
			                </div>
			                </a>    
		                </div>
					</div>      
		        @endforeach
			</div>				
		</div>	

	</div>
</div>
@endsection