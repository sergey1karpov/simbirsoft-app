@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif  
    <div class="row justify-content-center">
        <div class="col-12">
            <div>
                <h5 class="display-4">All users</h5>
                <a href="{{route('showCreateUserForm', ['id' => Auth::user()->id])}}">
                    <button class="btn btn-primary btn-lg btn-block mb-2">Create new user</button>
                </a>
                <ul class="list-group">
                    @foreach($allUsers as $allUser)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-8">
                                    {{$allUser->id}} | {{$allUser->name}} | {{$allUser->status}} | {{$allUser->role}} 
                                </div>
                                <div class="col-2 text-right">
                                    @if($allUser->role == 'User')
                                        <form action="{{route('changeRole', ['id' => Auth::user()->id, 'userId' => $allUser->id])}}" method="POST">
                                            @csrf @method('PATCH')
                                            <button class="btn btn-sm btn-success">Make moder</button>
                                        </form>
                                    @endif
                                    @if($allUser->role == 'Moderator')
                                        <form action="{{route('changeRole', ['id' => Auth::user()->id, 'userId' => $allUser->id])}}" method="POST">
                                            @csrf @method('PATCH')
                                            <button class="btn btn-sm btn-danger">Make user</button>
                                        </form>
                                    @endif
                                </div>
                                <div class="col-2 text-right">
                                    @if($allUser->status == 'Active')
                                        <form action="{{route('changeStatus', ['id' => Auth::user()->id, 'userId' => $allUser->id])}}" method="POST">
                                            @csrf @method('PATCH')
                                            <button class="btn btn-sm btn-danger">Banned</button>
                                        </form>
                                    @endif
                                    @if($allUser->status == 'Banned')
                                        <form action="{{route('changeStatus', ['id' => Auth::user()->id, 'userId' => $allUser->id])}}" method="POST">
                                            @csrf @method('PATCH')
                                            <button class="btn btn-sm btn-success">Activated</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul> 

                <h5 class="display-4">Ad on moderation</h5> 
                @if(count($moderationAds) == 0)
                    Nothing to moderation
                @endif
                @foreach($moderationAds as $ad)
                    <div class="col-4 mt-2" style="padding: 0">
                        <div class="card">
                            <div style="height:200px; background-size: cover; background-image: url({{$ad->photo}})"></div>
                            <div class="card-body" style="padding: 0">
                                <h4 class="card-title ml-1">{{$ad->title}}</h4>
                                <h6 class="ml-1">{{$ad->price}}</h6>
                                <div class="row text-center ml-1">
                                    <div class="col-4" style="padding: 0"> 
                                        <a href="{{route('showModerationOnAd', ['id' => $ad->user_id, 'ad' => $ad->id])}}" class="btn-sm btn btn-primary">Show</a>
                                    </div>
                                    <div class="col-4" style="padding: 0">
                                        <form action="{{route('makeActiveAd', ['id' => auth()->user()->id, 'ad' => $ad->id])}}" method="POST">
                                            @csrf @method('PATCH')
                                            <button class="btn btn-sm btn-primary">Activated</button>
                                        </form>
                                    </div>
                                    <div class="col-4" style="padding: 0">
                                        <form>
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach  
            </div>
        </div>
    </div>
</div>
@endsection

