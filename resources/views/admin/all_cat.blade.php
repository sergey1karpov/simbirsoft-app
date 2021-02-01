@extends('layouts.app')

@section('content')

<div class="container">
	@foreach($cats as $cat)
	<div class="modal fade" id="exampleModalCenter{{$cat->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  	<div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		    	<form class="m-3" action="{{ route('updateCat', ['id' => Auth::user()->id, 'cat' => $cat->id]) }}" method="POST">
					@csrf @method('PATCH')
					<div class="form-group">
	    				<label for="exampleInputEmail1">Category name</label>
	    				<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter category name" name="name" value="{{$cat->name}}">
	  				</div>
	  				<div class="form-group">
	    				<label for="exampleInputEmail1">Category slug</label>
	    				<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter category slug" name="slug" value="{{$cat->slug}}">
	  				</div>
	  				<div class="form-group">
	    				<label for="exampleFormControlTextarea1">Category description</label>
	    				<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description">{{$cat->description}}</textarea>
	  				</div>
	  				<button class="btn btn-sm btn-success">Edit</button>
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
			<form class="mb-5" action="{{ route('addCat', ['id' => Auth::user()->id]) }}" method="POST">
				@csrf
				<div class="form-group">
    				<label for="exampleInputEmail1">Category name</label>
    				<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter category name" name="name">
  				</div>
  				<div class="form-group">
    				<label for="exampleInputEmail1">Category slug</label>
    				<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="enter-category-slug" name="slug">
  				</div>
  				<div class="form-group">
    				<label for="exampleFormControlTextarea1">Category description</label>
    				<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
  				</div>
  				<button class="btn btn-sm btn-success">Adddd</button>
			</form>
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="col-10">
			<ul class="list-group">
				@foreach($cats as $cat)
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
    							<form action="{{ route('delCat', ['id' => Auth::user()->id, 'cat' => $cat->id]) }}" method="POST">
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