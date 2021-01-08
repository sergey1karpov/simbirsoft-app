@extends('layouts.app')

@section('content')

@if($user->status == 'No Active')
    <div class="alert alert-danger ml-5 mr-5">
        <h5>If you want publish your ads, please, activate you account</h5>
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
                <div class="col-4 mt-2">
                    <div class="card">
                        <img src="https://www.dummyimage.com/600x400/000/fff" class="img-fluid card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <a href="#" class="btn-sm btn btn-primary">show</a>
                        </div>
                    </div>
                </div>
                <div class="col-4 mt-2">
                    <div class="card">
                        <img src="https://www.dummyimage.com/600x400/000/fff" class="img-fluid card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <a href="#" class="btn-sm btn btn-primary">show</a>
                        </div>
                    </div>
                </div>
                <div class="col-4 mt-2">
                    <div class="card">
                        <img src="https://www.dummyimage.com/600x400/000/fff" class="img-fluid card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <a href="#" class="btn-sm btn btn-primary">show</a>
                        </div>
                    </div>
                </div>
            </div>

            <h4 class="mt-2">Drafts(This ads can be edited)</h4>
            <div class="row">
                <div class="col-4 mt-2">
                    <div class="card">
                        <img src="https://www.dummyimage.com/600x400/000/fff" class="img-fluid card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <a href="#" class="btn-sm btn btn-primary">show</a>
                        </div>
                    </div>
                </div>
                <div class="col-4 mt-2">
                    <div class="card">
                        <img src="https://www.dummyimage.com/600x400/000/fff" class="img-fluid card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <a href="#" class="btn-sm btn btn-primary">show</a>
                        </div>
                    </div>
                </div>
                <div class="col-4 mt-2">
                    <div class="card">
                        <img src="https://www.dummyimage.com/600x400/000/fff" class="img-fluid card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <a href="#" class="btn-sm btn btn-primary">show</a>
                        </div>
                    </div>
                </div>
            </div>

            <h4 class="mt-2">Ads on moderation(If ad have red border, ad == false, if green border, ad == wait, else ad moves to active)</h4>
            <div class="row">
                <div class="col-4 mt-2">
                    <div class="card" style="border: 4px solid red">
                        <img src="https://www.dummyimage.com/600x400/000/fff" class="img-fluid card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <a href="#" class="btn-sm btn btn-primary">show</a>
                        </div>
                    </div>
                </div>
                <div class="col-4 mt-2">
                    <div class="card" style="border: 4px solid green">
                        <img src="https://www.dummyimage.com/600x400/000/fff" class="img-fluid card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <a href="#" class="btn-sm btn btn-primary">show</a>
                        </div>
                    </div>
                </div>
                <div class="col-4 mt-2">
                    <div class="card" style="border: 4px solid green">
                        <img src="https://www.dummyimage.com/600x400/000/fff" class="img-fluid card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <a href="#" class="btn-sm btn btn-primary">show</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        </div>   
    </div>
</div>
@endsection