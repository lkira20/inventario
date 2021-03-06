@extends('layouts.admin')

@section('contenido')

	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de ventas<a href="{{ route('venta.create') }}" ><button class="btn btn-success">Nuevo</button></a></h3>

			@include('ventas.venta.search')
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Fecha</th>
						<th>Cliente</th>
						<th>Tipo Comprobante</th>
						<th>Impuesto</th>
						<th>Total venta</th>
						<th>Estado</th>
						<th>Opciones</th>
					</thead>
				@if(isset($ventas))
					@foreach($ventas as $vent)
					<tr>
						<td>{{ $vent->fecha_hora }}</td>
						<td>{{ $vent->persona->nombre }}</td>
						<td>{{ $vent->tipo_comprobante .': '. $vent->serie_comprobante . ' - ' . $vent->num_comprobante }}</td>
						<td>{{ $vent->impuesto }}</td>
						<td>{{ $vent->total_venta }}</td>
						<td>{{ $vent->estado }}</td>
						<td><a href="{{ route('venta.show', $vent) }}" class="btn btn-primary">detalles</a>
						<a href="" data-target="#modal-delete-{{ $vent->id }}" data-toggle="modal">
							<button type="submit" class="btn btn-danger">Eliminar</button>
						</a>
						</td>
					</tr>
					@include('ventas.venta.modal')
					@endforeach
				@endif
				</table>
			</div>

			{{ $ventas->render() }}
		</div>
	</div>

@endsection