@extends('layouts.admin')

@section('contenido')

	<div class="row">
		<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
			<div class="form-group">
				<label for="persona">Cliente</label>
				<p>{{ $venta->persona->nombre }}</p>
			</div>
		</div>
		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
			<div class="form-group">
				<label>Tipo Comprobante</label>
				<p>{{ $venta->tipo_comprobante }}</p>
			</div>
		</div>
		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
			<div class="form-group">
				<label for="serie_comprobante">Serie Comprobante</label>
				<p>{{ $venta->serie_comprobante }}</p>
			</div>
		</div>
		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
			<div class="form-group">
				<label for="num_comprobante">Numero Comprobante</label>
				<p>{{ $venta->num_comprobante }}</p>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-body">
				<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
					<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
						<thead style="background-color: #A9D0F5">
							<th>Articulo</th>
							<th>Cantidad</th>
							<th>Precio Venta</th>
							<th>Descuento</th>
							<th>Subtotal</th>
						</thead>
						<tbody>
							@if($detalle !== "")
								@foreach($detalle as $art)
									<tr>
										<td>{{ $art->nombre }}</td>
										<td>{{ $art->pivot->cantidad }}</td>
										<td>{{ $art->pivot->precio_venta }}</td>
										<td>{{ $art->pivot->descuento }}</td>
										<td>{{ $art->pivot->cantidad * $art->pivot->precio_venta - $art->pivot->descuento }}</td>
									</tr>
								@endforeach
							@endif
						</tbody>
						<tfoot>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th><h4 id="total">S/. {{ $venta->total_venta }}</h4></th>
						</tfoot>
					</table>
				</div>		
			</div>
		</div>
	</div>	

@endsection