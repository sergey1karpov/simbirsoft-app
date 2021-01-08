@extends('layouts.app')

@section('content')

@if($user->status == 'No Active')
    <div class="alert alert-danger ml-5 mr-5">
        <h5>If you want publish your ads, please, activate you account</h5>
    </div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif   
            <div class="col-12 text-center">
                <h5>New Ad</h5>
                <form action="{{route('createAd', Auth::user()->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input maxlength="50" type="text" class="form-control" id="title" aria-describedby="emailHelp" name="title">
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" id="category" name="category">
                            <option>PS5</option>
                            <option>PS4</option>
                            <option>PS3</option>
                            <option>XBOX X</option>
                            <option>XBOX S</option>
                            <option>XBOX One</option>
                            <option>XBOX 360</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <select class="form-control" id="city" name="city">
                            @foreach($cities as $city)
                                <option value="{{$city->id}}">{{$city->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea maxlength="500" class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="photo">Add main photo</label>
                        <input type="file" class="form-control-file" id="photo" name="photo" accept="image/jpeg,image/png">
                    </div>
                    <div class="form-group">
                        <label for="photos">Add up to 10 additional photos</label>
                        <input type="file" class="form-control-file" id="photos[]" name="photos[]" accept="image/jpeg,image/png" multiple>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input maxlength="20" type="text" class="form-control" id="price" aria-describedby="emailHelp" name="price">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        
        </div>   
    </div>
</div>
@endsection