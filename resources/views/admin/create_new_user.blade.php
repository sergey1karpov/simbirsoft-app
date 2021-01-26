@extends('layouts.app')

@section('content')

<div class="container">
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
	<div class="row text-center justify-content-center">
		<div class="col-8">
			<form action="{{route('createUser', ['id' => Auth::user()->id])}}" method="POST">
				@csrf
			  	<div class="form-group">
			    	<label for="name">User name</label>
			    	<input type="text" class="form-control" id="name" placeholder="name" name="name">
			  	</div>

			  	<div class="form-group">
			    	<label for="name">User surname</label>
			    	<input type="text" class="form-control" id="name" placeholder="surname" name="surname">
			  	</div>

			  	<div class="form-group">
			    	<label for="telephone">User telephone</label>
			    	<input type="text" class="form-control" id="telephone" placeholder="telephone" name="telephone">
			  	</div>

			  	<div class="form-group">
			    	<label for="email">User email</label>
			    	<input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
			  	</div>

			  	<div class="form-group">
                    <label for="role">User role</label>
                    <select class="form-control" id="role" name="role">
                        <option>User</option>
                        <option>Moderator</option>
                        <option>Admin</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="status">User status</label>
                    <select class="form-control" id="status" name="status">
                        <option>Active</option>
                        <option>No Active</option>
                    </select>
                </div>

			  	<!-- <div class="form-group">
			    	<label for="password">User password</label>
			    	<input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
			  	</div>

			  	<div class="form-group">
			    	<label for="password_confirmation">User confirm password</label>
			    	<input type="password" class="form-control" id="password_confirmation" placeholder="Confirm password" name="password_confirmation">
			  	</div> -->
			  
			 	<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
</div>

@endsection