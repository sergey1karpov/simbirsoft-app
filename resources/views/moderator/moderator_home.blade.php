@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
                

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h4 class="mt-2">You need to moderation this ads</h4>
                        <div class="row">
                            @foreach($ads as $ad)
                            <div class="col-4 mt-2">
                                <div class="card">
                                    <div style="height:200px; background-size: cover; background-image: url({{$ad->photo}})"></div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{$ad->title}}</h5>
                                        <a href="{{route('showModerationOnAd', ['id' => $ad->user_id, 'ad' => $ad->id])}}" class="btn-sm btn btn-primary">show</a>
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