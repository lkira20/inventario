@extends('layouts.admin')

@section('contenido')

	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Ingreso</h3>
			@if(count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
					@foreach($errors->all() as $error)	
						<li>{{ $error }}</li>
					@endforeach	
					</ul>
				</div>
			@endif
		</div>
	</div>
			{!! Form::model($ingreso,['method' => 'PATCH', 'action' => ['IngresoController@update', $ingreso]]) !!}

			{!! Form::token(); !!}
	<div class="row">
		<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
			<div class="form-group">
				<label for="persona">Proveedor</label>
				<select name="persona_id" id="persona_id" class="form-control selectpicker"data-live-search="true"> 
					@foreach($personas as $per)
					@if($ingreso->persona_id == $per->id)
					<option value="{{ $per->id }}" selected>{{ $per->nombre }}</option>
						@else 
						<option value="{{ $per->id }}">{{ $per->nombre }}</option>
					@endif
					@endforeach
				</select>
			</div>
		</div>
		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
			<div class="form-group">
				<label>Tipo Comprobante</label>
				<select name="tipo_comprobante" class="form-control">
					@if($ingreso->tipo_comprobante == 'Boleta')
						<option value="Boleta" selected>Boleta</option>
						@else
						<option value="Boleta">Boleta</option>
					@endif
					@if($ingreso->tipo_comprobante == 'Factura')
						<option value="Factura" selected>Factura</option>
						@else
						<option value="Factura">Factura</option>
					@endif
					@if($ingreso->tipo_comprobante == 'Ticket')
						<option value="Ticket" selected>Ticket</option>
						@else
						<option value="Ticket">Ticket</option>
					@endif
				</select>
			</div>
		</div>
		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
			<div class="form-group">
				<label for="serie_comprobante">Serie Comprobante</label>
				<input type="text" name="serie_comprobante" placeholder="Serie Comprobante" class="form-control" value="{{ $ingreso->serie_comprobante }}">
			</div>
		</div>
		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
			<div class="form-group">
				<label for="num_comprobante">Numero Comprobante</label>
				<input type="text" name="num_comprobante" placeholder="Numero Comprobante" class="form-control" value="{{ $ingreso->num_comprobante }}" required>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-body">
				<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 ">
					<div class="form-group">
						<label>Articulo</label>
						<select name="p_articulo_id" class="form-control selectpicker" id="p_articulo_id" data-live-search="true">
							@foreach($articulos as $art)
							<option value="{{ $art->id }}">{{ $art->nombre }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 ">
					<div class="form-group">
						<label for="p_cantidad">Cantidad</label>
						<input type="number" name="p_cantidad" id="p_cantidad" class="form-control" placeholder="cantidad">
					</div>
				</div>
				<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 ">
					<div class="form-group">
						<label for="p_precio_compra">Precio Compra</label>
						<input type="number" name="p_precio_compra" id="p_precio_compra" class="form-control" placeholder="Precio Compra">
					</div>
				</div>	
				<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 ">
					<div class="form-group">
						<label for="p_precio_venta">Precio Venta</label>
						<input type="number" name="p_precio_venta" id="p_precio_venta" class="form-control" placeholder="Precio Venta">
					</div>
				</div>
				<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 ">
					<div class="form-group">
						<label>Agregar a detalles</label>
						<button type="button" id="bt_add" class="btn btn-primary">Agregar articulo</button>
					</div>
				</div>	
				<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
					<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
						<thead style="background-color: #A9D0F5">
							<th>Opciones</th>
							<th>Articulo</th>
							<th>Cantidad</th>
							<th>Precio Compra</th>
							<th>Precio Venta</th>
							<th>Subtotal</th>
						</thead>
						<tbody>
							@foreach($ingreso->articulos as $cont => $articulo)
							<tr class="selected" id="fila{{$cont}}">
								<td>
									<button type="button" class="btn btn-warning" onclick="eliminar({{$cont}})">X</button>
								</td>
								<td>
									<input type="hidden" name="articulo_id[]" value="{{$articulo->id}}">{{$articulo->nombre}}
								</td>
								<td>
									<input type="number" name="cantidad[]" value="{{$articulo->stock}}">
								</td>
								<td>
									<input type="number" name="precio_compra[]" value="{{$articulo->pivot->precio_compra}}">
								</td>
								<td>
									<input type="number" name="precio_venta[]" value="{{$articulo->pivot->precio_venta}}">
								</td>
								<td id="sub">subtotal[cont]</td>
							</tr>
							@endforeach
						</tbody>
						<tfoot>
							<th>Total</th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th><h4 id="total">S/. 0.00</h4></th>
						</tfoot>
					</table>
				</div>		
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Agregar</button>
				<button class="btn btn-danger" type="reset">Borrar Campos</button>
			</div>
		</div>	
	</div>	
			{!! Form::close() !!}
@push('scripts')
<script>
	$(document).ready(function(){

		$('#bt_add').click(function(){
			agregar();
		});
	});

	var cont = 0;
	var total = 0;
	var subtotal = [];

	$("#guardar").hide();

	function agregar(){

		articulo_id = $("#p_articulo_id").val();
		articulo = $("#p_articulo_id option:selected").text();
		cantidad = $("#p_cantidad").val();
		precio_compra = $("#p_precio_compra").val();
		precio_venta = $("#p_precio_venta").val();

		if (articulo_id !== "" && cantidad !== "" && cantidad > 0 && precio_compra !== "") {

			subtotal[cont] = (cantidad * precio_compra);
			total = total + subtotal[cont];

			var fila = '<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">X</button></td><td><input type="hidden" name="articulo_id[]" value="'+articulo_id+'">'+articulo_id+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td><td><input type="number" name="precio_compra[]" value="'+precio_compra+'"></td><td><input type="number" name="precio_venta[]" value="'+precio_venta+'"></td><td>'+subtotal[cont]+'</td></tr>';

			cont++;

			limpiar();

			$("#total").html("$/. "+total);

			evaluar();

			$('#detalles').append(fila);
		}else{

			alert("Error al ingresar el detalle del ingreso, revise los datos del articulo");
		}
	}

	function limpiar(){
		$("#p_cantidad").val("");
		$("#p_precio_compra").val("");
		$("#p_precio_venta").val("");
	}

	function evaluar(){
			
		if (total > 0) {
			$("#guardar").show();
		}
		else{
			$("#guardar").hide();
		}
	}

	function eliminar(cont){
		total = total-subtotal[cont];
		$("#total").html("$/. "+total);
		$("#fila"+cont).remove();
		evaluar();
	}

	function establecersubtotal(cantidad, precio_compra, cont){

		subtotal[cont] = cantidad * precio_compra;
		total = total + subtotal[cont];

		return  subtotal[cont];
	}

	
</script>
@endpush	

@endsection