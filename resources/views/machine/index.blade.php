@extends('layouts.app')

@section('content')


<div class="panel panel-default">
	<!-- Default panel contents -->
	<div class="panel-heading">Status das Máquinas do LAE</div>

	<!-- Table -->
	<table id="table-machine" class="table table-striped table-bordered">
		<thead> 
			<tr> 
				<th>#</th> 
				<th>Endereço IP</th> 
				<th>Nome</th> 
				<th>Alocado para</th>
				<th>Status</th> 
				<th>Ultimo Contato a (minutos) </th>
				<th>Opções</th>
			</tr> 
		</thead>

		<tbody> 

			@foreach ($machines as $m)
			<tr> 
				
				<td>{{$m->id}}</td>

				<td>{{$m->ip_address}}</td> 
				
				<td style="text-transform: capitalize;">{{$m->name}}</td> 

				@if ($m->user != null)
					<td>{{$m->user->name}}</td> 
				@else
					<td>---</td> 
				@endif

				<td> <span id="ip{{$m->id}}" class="label label-default">loading</span> </td>

				<td> {{$m->updated_at->diffInMinutes()}} </td>
				
				<td>
					<div class="btn-group  btn-group-xs" role="group" aria-label="...">
						<a href="/edit/{{$m->id}}" class="btn btn-default" role="button">Editar</a>
						<a href="/delete/{{$m->id}}" class="btn btn-default" role="button">Delete</a>
					</div>
				</td>

			</tr> 
			@endforeach

		</tbody>
	</table>
</div>
{{-- <a href="/new" class="btn btn-default" role="button">Cadastrar nova maquina</a> --}}
<a id="reload" onclick="getstatus()" class="btn btn-default" role="button">Recarregar</a>

<p id="data"> </p>

@endsection


@if (auth()->check())
	@section('script')

	<script>
		
		function getstatus() {

			$('td').children('span').text("loading").removeClass().addClass('label label-default');

			$.get("{{ route('status_machine') }}", function(data, status){
				$.each(data, function(index, value){

					$("#ip"+index).removeClass();

					if(value == "online"){
						$("#ip"+index).addClass("label label-success");
						$("#ip"+index).text("online");
					}else{
						$("#ip"+index).addClass("label label-danger");
						$("#ip"+index).text("offline");
					}
				});
			});
		}

		getstatus();
		// setInterval(getstatus, 30*1000);
	</script>

	@endsection
@endif