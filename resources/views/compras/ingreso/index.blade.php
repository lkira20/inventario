@extends('layouts.admin')

@section('contenido')

	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Ingresos<a href="{{ route('ingreso.create') }}" ><button class="btn btn-success">Nuevo</button></a></h3>

			@include('compras.ingreso.search')
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Fecha</th>
						<th>Proveedor</th>
						<th>Tipo Comprobante</th>
						<th>Impuesto</th>
						<th>Total</th>
						<th>Estado</th>
						<th>Opciones</th>
					</thead>
				@if(isset($ingresos))
					@foreach($ingresos as $ing)
					<tr>
						<td>{{ $ing->fecha_hora }}</td>
						<td>{{ $ing->persona->nombre }}</td>
						<td>{{ $ing->tipo_comprobante .': '. $ing->impuesto . ' - ' . $ing->num_comprobante }}</td>
						<td>{{ $ing->serie_comprobante }}</td>
						<td>{{ $totales[$ing->id] }}</td>
						<td>{{ $ing->estado }}</td>
						<td><a href="{{ route('ingreso.show', $ing) }}" class="btn btn-primary">detalles</a>
						<a href="" data-target="#modal-delete-{{ $ing->id }}" data-toggle="modal">
							<button type="submit" class="btn btn-danger">Anular</button>
						</a>
						</td>
					</tr>
					@include('compras.ingreso.modal')
					@endforeach
				@endif
				</table>
			</div>

			{{ $ingresos->render() }}
		</div>
	</div>

@endsection