@extends('layouts.app')

@section('content')

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
                <h5>Edit ad</h5>
                <form action="{{route('updateDraftAd', ['id' => Auth::user()->id, 'ad' => $draftAd->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PATCH')
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input maxlength="50" type="text" class="form-control" id="title" aria-describedby="emailHelp" name="title" value="{{$draftAd->title}}">
                        <small>Current value: {{$draftAd->title}}</small>
                    </div>

                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" id="category" name="category_slug">
                            <option selected></option>
                            @foreach($categories as $category)
                                <option value="{{$category->slug}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        <small>Current value: {{$draftAd->category}}</small>
                    </div>
                    <div class="form-group">
                        <label for="category">Choose subCats</label>
                        <select class="form-control" id="category" name="category_subslug">
                            <option selected></option>
                            @foreach($subCats as $subCat)
                                <option value="{{$subCat->slug}}">{{$subCat->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="city">City</label>
                        <select class="form-control" id="city" name="city_slug">
                            <option selected></option>
                            @foreach($cities as $city)
                                <option value="{{$city->slug}}">{{$city->name}}</option>
                            @endforeach
                        </select>
                        <small>Current value: {{$city->name}}</small>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea maxlength="500" class="form-control" id="description" name="description" rows="3">{{$draftAd->description}}</textarea>
                        <small>Current value: {{$draftAd->description}}</small>
                    </div>
                    <div class="form-group">
                        <label for="photo">Add main photo</label>
                        <input type="file" class="form-control-file" id="photo" name="photo" accept="image/jpeg,image/png">
                        <small>Current main image:</small><br>
                        <img height="100" src="{{$draftAd->photo}}" >
                    </div>
                    <div class="form-group">
                        <label for="photos">Add up to 10 additional photos</label>
                        <input type="file" class="form-control-file" id="photos[]" name="photos[]" accept="image/jpeg,image/png" multiple>
                        <small>Current additional photos:</small><br>
                        @foreach(unserialize($draftAd->photos) as $ph)
                            <img height="100" src="{{$ph}}" >
                        @endforeach
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input maxlength="20" type="text" class="form-control" id="price" aria-describedby="emailHelp" name="price" value="{{$draftAd->price}}">
                        <small>Current price: {{$draftAd->price}}</small>
                    </div>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </form>
            </div>
        </div>
        
        </div>   
    </div>
</div>
@endsection