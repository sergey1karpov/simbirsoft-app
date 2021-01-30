@extends('layouts.app')

@section('content')

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif 

<div class="container">

    <div class="row">
        <div class="col-6">
            <div>
                <img src="{{$fullAd->photo}}" class="img-fluid">
            </div>
            <div id="carouselExampleControls" class="carousel slide mt-2" data-ride="carousel">
                <ol class="carousel-indicators">
                    @foreach( unserialize($fullAd->photos) as $index => $photo )
                        <li data-target="#carouselExampleIndicators" class="{{ $index == 0 ? 'active' : '' }}"></li>
                    @endforeach
                </ol>
             
                <div class="carousel-inner" role="listbox">
                    @foreach( unserialize($fullAd->photos) as $index => $photo  )
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <img class="d-block img-fluid" src="{{ $photo }}">
                        </div>
                    @endforeach
                </div>
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
                <h2 class="card-title">{{$fullAd->title}}</h2>
            </div>
            <div>
                <h5 class="card-title">{{$fullAd->description}}</h5>
            </div>
            <div>
                <h5 class="card-title">{{$fullAd->price}}</h5> 
            </div>
            <h3 class="mt-5">Contacts</h3>
            <div>
                <h5 class="card-title">{{$user->name}}</h5> 
            </div>
            <div>
                <h5 class="card-title">{{$user->email}}</h5> 
            </div>
        </div>
    </div>    

</div>	


@endsection

