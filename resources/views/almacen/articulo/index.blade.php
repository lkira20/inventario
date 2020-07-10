@extends('layouts.admin')

@section('contenido')

	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Articulos<a href="{{ route('articulo.create') }}" ><button class="btn btn-success">Nuevo</button></a></h3>

			@include('almacen.articulo.search')
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Id</th>
						<th>Nombre</th>
						<th>Codigo</th>
						<th>Categoria</th>
						<th>Stock</th>
						<th>Imagen</th>
						<th>Estado</th>
						<th>Opciones</th>
					</thead>
				@if(isset($articulos))
					@foreach($articulos as $art)
					<tr>
						<td>{{ $art->id }}</td>
						<td>{{ $art->nombre }}</td>
						<td>{{ $art->codigo }}</td>
						<td>{{ $art->categoria->nombre }}</td>
						<td>{{ $art->stock }}</td>
						<td><img src="{{ asset('/images/articulos/'.$art->imagen) }}" alt="{{ $art->nombre }}" width="100px" height="100px" class="img thumbnail"></td>
						<td>{{ $art->estado }}</td>
						<td><a href="{{ route('articulo.edit', $art) }}" class="btn btn-info">Editar</a>
						<a href="" data-target="#modal-delete-{{ $art->id }}" data-toggle="modal">
							<button type="submit" class="btn btn-danger">Eliminar</button>
						</a>
						</td>
					</tr>
					@include('almacen.articulo.modal')
					@endforeach
				@endif
				</table>
			</div>

			{{ $articulos->render() }}
		</div>
	</div>

@endsection