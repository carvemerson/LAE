@extends('layouts.app')

@section('content')


<div class="panel panel-default">
	<!-- Default panel contents -->
	<div class="panel-heading">LAE Machine Status</div>

	<!-- Table -->
	<table id="table-machine" class="table table-striped table-bordered">
		<thead> 
			<tr> 
				<th>#</th> 
				<th>IP address</th> 
				<th>Machine Name</th> 
				<th>User Name</th>
				<th>Status</th> 
				<th>Last Contact</th>
				<th>Uptime</th>
				<th>Options</th>
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
					<td>-----</td> 
				@endif

				<td> <span id="ip{{$m->id}}" class="label label-default">loading</span> </td>


				@if($m->last_contact != null)
					
					<td> {{$m->last_contact->diffForHumans()}} </td>
					
				@else

					<td> ----- </td>
					
				@endif

				@if($m->uptime != null)
					
					<td> {{$m->uptime->diffForHumans()}} </td>
					
				@else

					<td> ----- </td>
					
				@endif
				
				
				<td>

					@if(Gate::check('edit', $m) )
						<div class="btn-group  btn-group-xs" role="group" aria-label="...">
							<a href="/edit/{{$m->id}}" class="btn btn-default" role="button">Editar</a>
							
							<a href="#" data-href="/delete/{{$m->id}}" data-toggle="modal" data-target="#confirm-delete" class="btn btn-default" role="button">Delete</a>
						</div>
					@else
						-----
					@endif
				</td>

			</tr> 
			@endforeach

		</tbody>
	</table>
</div>

@include('confirmation.confirmdialog')
{{-- <a href="/new" class="btn btn-default" role="button">Cadastrar nova maquina</a> --}}
{{-- <a id="reload" onclick="getstatus()" class="btn btn-default" role="button">Reload</a> --}}

<p id="data"> </p>

@endsection


@section('script')
	@if (auth()->check())

	<script>
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
            $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
        });
    </script>

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
	
	@endif
@endsection