@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-4">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif   
            <div class="col-12 text-center">
                <h5>New Ad</h5>
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="email" class="form-control" id="title" aria-describedby="emailHelp" name="title">
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" id="category" name="category">
                            <option>Cars</option>
                            <option>Furniture</option>
                            <option>Games</option>
                            <option>Animals</option>
                            <option>Peoples</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <select class="form-control" id="city" name="city">
                            <option>Moscow</option>
                            <option>Ulyanovsk</option>
                            <option>Omsk</option>
                            <option>Tambov</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="photos">Images</label>
                        <input type="file" class="form-control-file" id="photos[]" name="photos" multiple>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="email" class="form-control" id="price" aria-describedby="emailHelp" name="price">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        
        <div class="col-8">
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