@extends('layouts.app')

@section('content')
<div class="container">

@foreach($regions as $reg)
<div class="modal fade" id="updateRegion{{$reg->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	    	<form action="{{ route('updateRegion', ['id' => Auth::user()->id, 'region' => $reg->id]) }}" method="POST">
	    		@csrf @method('PATCH')
	    		<div class="form-group">
    				<label for="exampleInputPassword1">Password</label>
    				<input type="text" class="form-control" id="exampleInputPassword1" placeholder="Region name" name="upd_region_name" value="{{$reg->name}}">
  				</div>
  				<div class="form-group">
    				<label for="exampleInputPassword1">Password</label>
    				<input type="text" class="form-control" id="exampleInputPassword1" placeholder="Region slug" name="upd_region_slug" value="{{$reg->slug}}">
  				</div>
  				<button type="submit" class="btn btn-primary">Submit</button>
	    	</form>
	    </div>
	</div>
</div>
@endforeach

<div class="modal fade" id="regionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	    	<form action="{{ route('addRegion', ['id' => Auth::user()->id]) }}" method="POST">
	    		@csrf
	    		<div class="form-group">
    				<label for="exampleInputPassword1">Region name</label>
    				<input type="text" class="form-control" id="exampleInputPassword1" placeholder="Region name" name="region_name">
  				</div>
  				<div class="form-group">
    				<label for="exampleInputPassword1">Region slug</label>
    				<input type="text" class="form-control" id="exampleInputPassword1" placeholder="Region slug" name="region_slug">
  				</div>
  				<button type="submit" class="btn btn-primary">Submit</button>
	    	</form>
	    </div>
	</div>
</div>

<div class="modal fade" id="cityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
	    <div class="modal-content">
	    	<form action="{{ route('addCity', ['id' => Auth::user()->id]) }}" method="POST">
	    		@csrf
	    		<div class="form-group">
    				<label for="exampleFormControlSelect1">Region</label>
				    <select class="form-control" id="exampleFormControlSelect1" name="region_id">
				    	@foreach($regions as $regs)
				      		<option value="{{$regs->id}}">{{$regs->name}}</option>
				      	@endforeach	
				    </select>
  				</div>
  				<div class="form-group">
    				<label for="exampleFormControlSelect1">Region slug</label>
				    <select class="form-control" id="exampleFormControlSelect1" name="region_slug">
				    	@foreach($regions as $regslug)
				      		<option value="{{$regslug->slug}}">{{$regslug->slug}}</option>
				      	@endforeach	
				    </select>
  				</div>
	    		<div class="form-group">
    				<label for="exampleInputPassword1">Name</label>
    				<input type="text" class="form-control" id="exampleInputPassword1" placeholder="City name" name="city_name">
  				</div>
  				<div class="form-group">
    				<label for="exampleInputPassword1">Slug</label>
    				<input type="text" class="form-control" id="exampleInputPassword1" placeholder="City slug" name="city_slug">
  				</div>
  				<button type="submit" class="btn btn-primary">Submit</button>
	    	</form>
	    </div>
    </div>
</div>

@foreach($cities as $city)
<div class="modal fade" id="updateCity{{$city->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
	    <div class="modal-content">
	    	<form action="{{ route('updateCity', ['id' => Auth::user()->id, 'city' => $city->id]) }}" method="POST">
	    		@csrf @method('PATCH')
	    		<div class="form-group">
    				<label for="exampleFormControlSelect1">Region</label>
				    <select class="form-control" id="exampleFormControlSelect1" name="up_region_id">
				    	@foreach($regions as $regs)
				      		<option value="{{$regs->id}}">{{$regs->name}}</option>
				      	@endforeach	
				    </select>
  				</div>
  				<div class="form-group">
    				<label for="exampleFormControlSelect1">Region slug</label>
				    <select class="form-control" id="exampleFormControlSelect1" name="up_region_slug">
				    	@foreach($regions as $regslug)
				      		<option value="{{$regslug->slug}}">{{$regslug->slug}}</option>
				      	@endforeach	
				    </select>
  				</div>
	    		<div class="form-group">
    				<label for="exampleInputPassword1">Name</label>
    				<input type="text" class="form-control" id="exampleInputPassword1" placeholder="City name" name="up_city_name" value="{{$city->name}}">
  				</div>
  				<div class="form-group">
    				<label for="exampleInputPassword1">Slug</label>
    				<input type="text" class="form-control" id="exampleInputPassword1" placeholder="City slug" name="up_city_slug" value="{{$city->slug}}">
  				</div>
  				<button type="submit" class="btn btn-primary">Submit</button>
	    	</form>
	    </div>
    </div>
</div>
@endforeach

	<div class="row">
		<div class="col-6">
			<form>
				<button data-toggle="modal" data-target="#regionModal" type="button" class="btn btn-primary btn-lg btn-block">Add region</button>
			</form>
			<ul class="list-group mt-2">
				@foreach($regions as $reg)
					<li class="list-group-item">
						<div class="row">
							<div class="col-8">
								{{$reg->name}}
							</div>
							<div class="col-2">
								<button data-toggle="modal" data-target="#updateRegion{{$reg->id}}" class="btn btn-sm btn-success">Edit</button>
							</div>
							<div class="col-2">
								<form action="{{ route('deleteRegion', ['id' => Auth::user()->id, 'region' => $reg->id]) }}" method="POST">
									@csrf @method('DELETE')
									<button class="btn btn-sm btn-danger">Del</button>
								</form>
							</div>
						</div>
					</li>
				@endforeach
			</ul>
		</div>
		<div class="col-6">
			<form>
				<button data-toggle="modal" data-target="#cityModal" type="button" class="btn btn-primary btn-lg btn-block">Add city</button>
			</form>
			<ul class="list-group mt-2">
				@foreach($cities as $city)
					<li class="list-group-item">
						<div class="row">
							<div class="col-8">
								{{$city->name}}
							</div>
							<div class="col-2">
								<button data-toggle="modal" data-target="#updateCity{{$city->id}}" class="btn btn-sm btn-success">Edit</button>
							</div>
							<div class="col-2">
								<form action="{{ route('deleteCity', ['id' => Auth::user()->id, 'city' => $city->id]) }}" method="POST">
									@csrf @method('DELETE')
									<button class="btn btn-sm btn-danger">Del</button>
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