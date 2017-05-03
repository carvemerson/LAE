@extends('layouts.app')


@section('content')
	<form method="POST" action="/edit/{{$machine->id}}">

	{{csrf_field()}}

	<div class="form-group">
		<label for="name">Machine Name:</label>
		<input type="text" class="form-control" id="name" name="name" value="{{$machine->name}}"> 
	</div>

	<div class="form-group">
		<label for="ip_address">IP Address:</label>
		<input type="ip" class="form-control" id="ip_address" name="ip_address" value="{{$machine->ip_address}}">
	</div>
	
	<div class="form-group">
	  <label for="user_id">Alocated To:</label>
	  <select class="form-control" id="user_id" name="user_id">
	  	<option value="null"> </option>}
	  	@foreach ($users as $user)	
		  	@if($machine->user->id == $user->id)
		  	    <option selected="selected" value="{{$user->id}}"> {{$user->name}}</option>}			  
			@else
				<option value="{{$user->id}}"> {{$user->name}}</option>}	
			@endif
	  	@endforeach
	  </select>
	</div>
	

	<div class="form-group">
		<button type="submit" class="btn btn-default">Save</button>
	</div>

	

	<div class="form-group">
		@include('machine.errors')
	</div>
</form>

@endsection