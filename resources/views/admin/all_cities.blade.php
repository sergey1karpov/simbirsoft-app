@extends('layouts.app')

@section('content')
<div class="container">

	@foreach($cities as $city)
	<div class="modal fade" id="exampleModalCenter{{$city->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  	<div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		    	<form class="m-3" action="{{ route('updateCity', ['id' => Auth::user()->id, 'city' => $city->id]) }}" method="POST">
					@csrf @method('PATCH')
					<div class="form-group">
	    				<label for="exampleInputEmail1">City name</label>
	    				<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter category name" name="name" value="{{$city->name}}">
	  				</div>
	  				<div class="form-group">
	    				<label for="exampleInputEmail1">City slug</label>
	    				<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter category slug" name="slug" value="{{$city->slug}}">
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
			<form class="mb-5" action="{{ route('addCity', ['id' => Auth::user()->id]) }}" method="POST">
				@csrf
  				<div class="form-group">
    				<label for="exampleInputEmail1">City name</label>
    				<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="enter-category-slug" name="name">
  				</div>
  				<div class="form-group">
    				<label for="exampleInputEmail1">City slug</label>
    				<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="enter-category-slug" name="slug">
  				</div>
  				<button class="btn btn-sm btn-success">Adddd</button>
			</form>
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="col-10">
			<ul class="list-group">
				@foreach($cities as $city)
    				<li class="list-group-item">
    					<div class="row">
    						<div class="col-8">
    							{{$city->name}}
    						</div>
    						<div class="col-2 text-right">
    							<form>
    								<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter{{$city->id}}">Edit</button>
    							</form>
    						</div>
    						<div class="col-2 text-right">
    							<form action="{{ route('delCity', ['id' => Auth::user()->id, 'city' => $city->id]) }}" method="POST">
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