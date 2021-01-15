@extends('layouts.app')

@section('content')

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif 

<div class="container">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            @foreach($categories->reverse() as $category)
                <li class="breadcrumb-item active" aria-current="page">{{$category->name}}</li>
            @endforeach
        </ol>
    </nav>

    @if($whyFalse)
        @if($whyFalse->decesion == 'False')
            <h2>Check your ad and send on moderation again</h2>
            <form action="{{route('sendToModer', ['id' => Auth::user()->id, 'ad' => $draftAd->id])}}" method="post">
                @csrf @method('PATCH')
                <button class="btn btn-primary">Send to moderation</button>
            </form>

            <h2>You ad is rejected for reason:</h2>
            <div class="alelrt alert-danger">
                <h6>{{$whyFalse->why}}</h6>
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
			<div class="card-body">
                <img src="{{$draftAd->photo}}" class="img-fluid">
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

