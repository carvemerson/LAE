@extends('layouts.app')


@section('content')
{{-- <a href="/" class="btn btn-default" role="button" style="margin-bottom: 2em">Mostrar status das máquinas</a>
--}}
<form method="POST" action="{{ route('store_machine') }}">

	{{csrf_field()}}

	<div class="form-group">
		<label for="name">Machine Name:</label>
		<input type="text" class="form-control" id="name" name="name">
	</div>

	<div class="form-group">
		<label for="ip_address">IP Address:</label>
		<input type="ip" class="form-control" id="ip_address" name="ip_address">
	</div>
	

	<div class="form-group">
	  <label for="user_id">Alocated To:</label>
	  <select class="form-control" id="user_id" name="user_id">
	
	  	<option value="null"> </option>}
	  	@foreach ($users as $user)	
	  	    <option value="{{$user->id}}"> {{$user->name}}</option>}
	  	@endforeach
	  </select>
	</div>
	
	<div class="form-group">
		<button type="submit" class="btn btn-default">Submit</button>
	</div>

	<div class="form-group">
		@include('machine.errors')
	</div>
</form>

@endsection