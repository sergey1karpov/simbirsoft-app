@extends('layouts.app')

@section('content')

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif 

<div class="container">
	<div class="row">
			<div class="card-body">
                <h5>Ad by {{$userAd->name}}</h5>
                <img src="{{$ad->photo}}" class="img-fluid">
                <h3 class="card-title">{{$ad->title}}</h3>
                <h5 class="card-title">{{$ad->description}}</h5> 
                <h5 class="card-title">{{$ad->price}}</h5> 
       			@foreach(unserialize($ad->photos) as $ph)
       				<img src="{{$ph}}" class="img-fluid">
       			@endforeach
                
            </div>
		
	</div>

    <h4>Why this ad is shit?</h4>
    <form action="{{route('why', ['id' => Auth::user()->id, 'ad' => $ad->id])}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Example textarea</label>
            <textarea name="why" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <button class="btn btn-primary btn-sm">Send</button>
    </form>
</div>	

@endsection