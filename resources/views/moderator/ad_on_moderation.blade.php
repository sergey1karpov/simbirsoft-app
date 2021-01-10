@extends('layouts.app')

@section('content')

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif 

<div class="container">
	<div class="row">
        <h5>Ad by {{$userAd->name}}</h5>
			<img src="{{$ad->photo}}" class="img-fluid">
			<div class="card-body">
                <h3 class="card-title">{{$ad->title}}</h3>
                <h5 class="card-title">{{$ad->description}}</h5> 
                <h5 class="card-title">{{$ad->price}}</h5> 
       			@foreach(unserialize($ad->photos) as $ph)
       				<img src="{{$ph}}" class="img-fluid">
       			@endforeach
                
            </div>
		
	</div>
</div>	
@endsection