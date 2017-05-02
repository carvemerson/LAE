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
		<label for="alocated_to">Alocated To:</label>
		<input type="text" class="form-control" id="alocated_to" name="alocated_to" value="{{$machine->alocated_to}}">
	</div>

	<div class="form-group">
		<label for="alocated_to">Status:</label>
		<input type="text" class="form-control" id="status" name="status" value="{{$machine->status}}">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-default">Salvar</button>
	</div>

	<div class="form-group">
		@include('machine.errors')
	</div>
</form>

@endsection