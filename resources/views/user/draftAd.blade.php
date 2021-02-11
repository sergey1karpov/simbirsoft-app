@extends('layouts.app')

@section('content')

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif 

<div class="container">
    

    @if($whyFalse)
        @if($whyFalse->decesion == 'False')
            <h2>Check your ad and send on moderation again</h2>
            <form action="{{route('sendToModer', ['id' => Auth::user()->id, 'ad' => $draftAd->id])}}" method="post">
                @csrf @method('PATCH')
                <button class="btn btn-primary">Send to moderation again</button>
            </form>

            <h2>You ad is rejected for reason:</h2>
            <div class="alelrt alert-danger">
                <h4 class="p-4">{{$whyFalse->why}} ({{$whyFalse->created_at}})</h4>
            </div>
        @endif
    @endif    

    @if($draftAd->status == 'on moderation')
        <h2>Please wait:</h2>
        <div class="alelrt alert-success">
            <h6>Wait, you ad is on moderation</h6>
        </div>
    @endif

    <div class="row">
        <div class="col-6">
            <div>
                <img src="{{$draftAd->photo}}" class="img-fluid">
                <small class="text-muted">Main image</small>
            </div>
            <div id="carouselExampleControls" class="carousel slide mt-2" data-ride="carousel">
                <ol class="carousel-indicators">
                    @foreach( unserialize($draftAd->photos) as $index => $photo )
                        <li data-target="#carouselExampleIndicators" class="{{ $index == 0 ? 'active' : '' }}"></li>
                    @endforeach
                </ol>
             
                <div class="carousel-inner" role="listbox">
                    @foreach( unserialize($draftAd->photos) as $index => $photo  )
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
                <h2 class="card-title">{{$draftAd->title}}</h2>
            </div>
            <div>
                <h5 class="card-title">{{$draftAd->description}}</h5>
            </div>
            <div>
                <h5 class="card-title">{{$draftAd->price}}</h5> 
            </div>
        </div>
    </div>    

	<div class="row mt-2" style="padding-left: 15px">
        <div class="mr-1">
            <a href="{{route('editDraftAd', ['id' => Auth::user()->id, 'ad' => $draftAd->id])}}" class="btn-sm btn btn-primary">edit</a>
        </div>
        <div class="ml-1 mr-1">
            <form action="{{route('deleteDraftAd', ['id' => Auth::user()->id, 'ad' => $draftAd->id])}}" method="post">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm">delete</button>
            </form>
        </div>
        @if($draftAd->status == 'Draft')
        <div class="ml-1">
            <form action="{{route('sendToModer', ['id' => Auth::user()->id, 'ad' => $draftAd->id])}}" method="post">
                @csrf @method('PATCH')
                <button class="btn-sm btn btn-primary">Send to moder</button>
            </form>
        </div>
        @endif
	</div>
</div>	


@endsection

