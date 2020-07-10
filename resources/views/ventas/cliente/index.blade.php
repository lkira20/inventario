@extends('layouts.admin')

@section('contenido')

	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Clientes<a href="{{ route('cliente.create') }}" ><button class="btn btn-success">Nuevo</button></a></h3>

			@include('ventas.cliente.search')
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Id</th>
						<th>Nombre</th>
						<th>Tipo de documento</th>
						<th>Numero de documento</th>
						<th>Direccion</th>
						<th>Telefono</th>
						<th>Email</th>
						<th>Opciones</th>
					</thead>
				@if(isset($personas))
					@foreach($personas as $per)
					<tr>
						<td>{{ $per->id }}</td>
						<td>{{ $per->nombre }}</td>
						<td>{{ $per->tipo_documento }}</td>
						<td>{{ $per->num_documento }}</td>
						<td>{{ $per->direccion }}</td>
						<td>{{ $per->telefono }}</td>
						<td>{{ $per->email }}</td>
						<td><a href="{{ route('cliente.edit', $per) }}" class="btn btn-info">Editar</a>
						<a href="" data-target="#modal-delete-{{ $per->id }}" data-toggle="modal">
							<button type="submit" class="btn btn-danger">Eliminar</button>
						</a>
						</td>
					</tr>
					@include('ventas.cliente.modal')
					@endforeach
				@endif
				</table>
			</div>

			{{ $personas->render() }}
		</div>
	</div>

@endsection