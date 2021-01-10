@extends('layouts.app')

@section('content')

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif 

<div class="container">
	<div class="row">
			<img src="{{$draftAd->photo}}" class="img-fluid">
			<div class="card-body">
                <h3 class="card-title">{{$draftAd->title}}</h3>
                <h5 class="card-title">{{$draftAd->description}}</h5> 
                <h5 class="card-title">{{$draftAd->price}}</h5> 
       			@foreach(unserialize($draftAd->photos) as $ph)
       				<img src="{{$ph}}" class="img-fluid">
       			@endforeach
                <a href="{{route('editDraftAd', ['id' => Auth::user()->id, 'ad' => $draftAd->id])}}" class="btn-sm btn btn-primary">edit</a>
                <form action="{{route('deleteDraftAd', ['id' => Auth::user()->id, 'ad' => $draftAd->id])}}" method="post">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger">delete</button>
                            </form>
            </div>
		
	</div>
</div>	
@endsection