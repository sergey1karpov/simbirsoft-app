@extends('layouts.app')

@section('content')

@if($user->status == 'No Active')
    <div class="alert alert-danger ml-5 mr-5">
        <h5>If you want publish your ads, please, activate you account</h5>
    </div>
@endif

@if (session('status'))
    <div class="alert alert-success ml-5 mr-5" role="alert">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif 

<div class="container">
    <div class="mb-5">
        <a href="{{route('showForm', Auth::user()->id)}}">
            <button type="button" class="btn btn-primary btn-lg btn-block">New Ad</button>
        </a>
    </div>
    <div class="row justify-content-center">
        
        <div class="col-12">
            <h4>My active ads</h4>
            <div class="row">
                @foreach($activeAds as $activeAd)
                    <div class="col-4 mt-2">
                        <div class="card">
                            <div style="height:200px; background-size: cover; background-image: url({{$activeAd->photo}})"></div>
                            <div class="card-body">
                                <h5 class="card-title">{{$activeAd->title}}</h5>
                                <h6 class="card-title">{{$activeAd->price}} rubles</h6>
                                <a href="#" class="btn-sm btn btn-primary">show</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <h4 class="mt-2">Drafts(This ads can be edited)</h4>
            <div class="row">
                @foreach($draftAds as $draftAd)
                <div class="col-4 mt-2">
                    <div class="card">
                        <div style="height:200px; background-size: cover; background-image: url({{$draftAd->photo}})"></div>
                        <div class="card-body" style="padding: 0">
                            <h5 style="padding-left: 4px; padding-right: 4px" class="card-title">{{$draftAd->title}}</h5>
                            <div class="row mb-1" style="padding-left: 4px; padding-right: 4px">
                                <div class="col-2" style="padding-right: 0">
                                    <a href="{{route('showAd', ['id' => Auth::user()->id, 'ad' => $draftAd->id])}}" class="btn-sm btn btn-primary">Show</a>
                                </div>
                                <div class="col-2" style="padding: 0">
                                    <a href="{{route('editDraftAd', ['id' => Auth::user()->id, 'ad' => $draftAd->id])}}" class="btn-sm btn btn-primary">Edit</a>
                                </div>
                                <div class="col-3" style="padding: 0">
                                    <form action="{{route('deleteDraftAd', ['id' => Auth::user()->id, 'ad' => $draftAd->id])}}" method="post">
                                        @csrf @method('DELETE')
                                        <button style="padding: " class="btn-sm btn btn-danger">DELETE</button>
                                    </form>
                                </div>
                                <div class="col-5 text-right" style="padding-left: 0">
                                    <form action="{{route('sendToModer', ['id' => Auth::user()->id, 'ad' => $draftAd->id])}}" method="post">
                                        @csrf @method('PATCH')
                                        <button class="btn-sm btn btn-primary">Send to moder</button>
                                    </form>
                                </div>
                            </div>
                            
                            
                            
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
      
            <h4 class="mt-2">Ads on moderation</h4>
            <div class="row">
                @foreach($moderationAds as $moderationAd)
                <div class="col-4 mt-2">
                    <div class="card" 
                    @if($moderationAd->status == 'On Moderation')style="border: 4px solid yellow" @endif
                    @if($moderationAd->status == 'Rejected')style="border: 4px solid red" @endif    
                    >
                        <div style="height:200px; background-size: cover; background-image: url({{$moderationAd->photo}})"></div>
                        <div class="card-body">
                            <h5 class="card-title">{{$moderationAd->title}}</h5>
                            <a href="{{route('showAd', ['id' => Auth::user()->id, 'ad' => $moderationAd->id])}}" class="btn-sm btn btn-primary">show</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <h4 class="mt-2">Deleted ads</h4>
            <div class="row">
                @foreach($deleted as $del)
                <div class="col-3 mt-2">
                    <div class="card" style="background-color:rgba(0,0,0,.3);">
                        <div style="height:200px; background-size: cover; background-image: url({{$del->photo}})"></div>
                        <div class="card-body">
                            <h5 class="card-title">{{$del->title}}</h5>
                            <a href="{{route('showAd', ['id' => Auth::user()->id, 'ad' => $del->id])}}" class="btn-sm btn btn-primary">show</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        </div>   
    </div>
</div>
@endsection