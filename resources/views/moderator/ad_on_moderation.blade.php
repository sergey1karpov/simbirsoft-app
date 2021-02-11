@extends('layouts.app')

@section('content')

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif 

<div class="container">
	<!-- <div class="row">
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
	</div> -->

    <div class="row">
        <div class="col-6">
            <div>
                <img src="{{$ad->photo}}" class="img-fluid">
                <small class="text-muted">Main image</small>
            </div>
            <div id="carouselExampleControls" class="carousel slide mt-2" data-ride="carousel">
                <ol class="carousel-indicators">
                    @foreach( unserialize($ad->photos) as $index => $photo )
                        <li data-target="#carouselExampleIndicators" class="{{ $index == 0 ? 'active' : '' }}"></li>
                    @endforeach
                </ol>
             
                <div class="carousel-inner" role="listbox">
                    @foreach( unserialize($ad->photos) as $index => $photo  )
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <img class="d-block img-fluid" src="{{ $photo }}">
                        </div>
                    @endforeach
                </div>
                <small class="text-muted">Additional images</small>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div> 
        </div>
        <div class="col-6">
            <div>
                <h2 class="card-title">{{$ad->title}}</h2>
            </div>
            <div>
                <h5 class="card-title">{{$ad->description}}</h5>
            </div>
            <div>
                <h5 class="card-title">{{$ad->price}}</h5> 
            </div>
        </div>
    </div>

    <h4>Reason for sending the ad for revision</h4>
    <form action="{{route('why', ['id' => Auth::user()->id, 'ad' => $ad->id])}}" method="POST">
        @csrf
        <div class="form-group">
            <textarea name="why" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <button class="btn btn-primary btn-sm">Send</button>
    </form>
</div>	

@endsection