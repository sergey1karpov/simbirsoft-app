@extends('layouts.app')

@section('content')

<div class="container">
    @foreach($subCats as $cat)
    	<div class="modal fade" id="exampleModalCenter{{$cat->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="m-3" action="{{ route('updateSubCats', ['id' => Auth::user()->id, 'category' => $parCat->slug, 'subcate' => $cat->id]) }}" method="POST">
                        @csrf @method('PATCH')
                        <div class="form-group">
                            <label for="exampleInputEmail1">SubCategory name</label>
                            <input value="{{$cat->name}}" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter category name" name="up_sub_name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">SubCategory slug</label>
                            <input value="{{$cat->slug}}" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="enter-category-slug" name="up_sub_slug">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">SubCategory description</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="up_sub_description">{{$cat->description}}</textarea>
                        </div>
                        <button class="btn btn-sm btn-success">Update</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

	@if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif  
	<div class="row justify-content-center">
		<div class="col-10">
			<h4 class="display-4">Add subcategory for {{$parCat->name}}</h4>
			<form class="mb-5" action="{{ route('addSubCats', ['id' => Auth::user()->id, 'category' => $parCat->slug]) }}" method="POST">
				@csrf
				<div class="form-group">
    				<label for="exampleInputEmail1">SubCategory name</label>
    				<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter category name" name="sub_name">
  				</div>
  				<div class="form-group">
    				<label for="exampleInputEmail1">SubCategory slug</label>
    				<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="enter-category-slug" name="sub_slug">
  				</div>
  				<div class="form-group">
    				<label for="exampleFormControlTextarea1">SubCategory description</label>
    				<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="sub_description"></textarea>
  				</div>
  				<button class="btn btn-sm btn-success">Adddd</button>
			</form>
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="col-10">
			<ul class="list-group">
				@foreach($subCats as $cat)
    				<li class="list-group-item">
    					<div class="row">
    						<div class="col-8">
                                {{$cat->name}}	
    						</div>
    						<div class="col-2 text-right">
    							<form>
    								<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter{{$cat->id}}">Edit</button>
    							</form>
    						</div>
    						<div class="col-2 text-right">
    							<form action="{{ route('deleteSubCats', ['id' => Auth::user()->id, 'category' => $parCat->slug, 'subcate' => $cat->id]) }}" method="POST">
    								@csrf @method('DELETE')
    								<button class="btn btn-danger btn-sm">Delete</button>
    							</form>
    						</div>
    					</div>
    				</li>
    			@endforeach
			</ul>
		</div>
	</div>
</div>
@endsection