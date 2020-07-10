@extends('layouts.admin')

@section('contenido')

	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Venta</h3>
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
			{!! Form::open(['url' => '/ventas/venta', 'method' => 'POST', 'autocomplete' => 'off']) !!}

			{!! Form::token(); !!}
	<div class="row">
		<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
			<div class="form-group">
				<label for="persona">Cliente</label>
				<select name="persona_id" id="persona_id" class="form-control selectpicker"data-live-search="true"> 
					@foreach($personas as $per)
					<option value="{{ $per->id }}">{{ $per->nombre }}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
			<div class="form-group">
				<label>Tipo Comprobante</label>
				<select name="tipo_comprobante" class="form-control">
						<option value="Boleta">Boleta</option>
						<option value="Factura">Factura</option>
						<option value="Ticket">Ticket</option>
				</select>
			</div>
		</div>
		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
			<div class="form-group">
				<label for="serie_comprobante">Serie Comprobante</label>
				<input type="text" name="serie_comprobante" placeholder="Serie Comprobante" class="form-control" value="{{ old('serie_comprobante') }}">
			</div>
		</div>
		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
			<div class="form-group">
				<label for="num_comprobante">Numero Comprobante</label>
				<input type="text" name="num_comprobante" placeholder="Numero Comprobante" class="form-control" value="{{ old('num_comprobante') }}" required>
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
							<option value="{{ $art->id }}_{{ $art->stock }}_{{ $promedio[$art->id] }}_{{ $art->nombre }}">{{ $art->nombre }}</option>
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
						<label for="p_stock">Stock</label>
						<input type="number" disabled name="p_stock" id="p_stock" class="form-control" placeholder="Stock">
					</div>
				</div>
				<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 ">
					<div class="form-group">
						<label for="p_precio_venta">Precio Venta</label>
						<input type="number" disabled  name="p_precio_venta" id="p_precio_venta" class="form-control" placeholder="Precio Venta">
					</div>
				</div>
				<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 ">
					<div class="form-group">
						<label for="p_descuento">Descuento</label>
						<input type="number" name="p_descuento" id="p_descuento" class="form-control" placeholder="Descuento">
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
							<th>Precio Venta</th>
							<th>Descuento</th>
							<th>Subtotal</th>
						</thead>
						<tbody>
							
						</tbody>
						<tfoot>
							<td>Total</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td><h4 id="total">S/. 0.00</h4><input type="hidden" name="total_venta" id="total_venta"></td>
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
	$("#p_articulo_id").change(mostrarValores);

	function mostrarValores(){

		datosArticulo = document.getElementById('p_articulo_id').value.split('_');
		$("#p_precio_venta").val(datosArticulo[2]);
		$("#p_stock").val(datosArticulo[1]);		
	}

	function agregar(){

		datosArticulo = document.getElementById('p_articulo_id').value.split('_');

		articulo_nombre = datosArticulo[3];
		articulo_id = datosArticulo[0];
		articulo = $("#p_articulo_id option:selected").text();
		cantidad = $("#p_cantidad").val();
		descuento = $("#p_descuento").val();
		precio_venta = $("#p_precio_venta").val();
		stock = $("#p_stock").val();

		if (articulo_id !== "" && cantidad !== "" && cantidad > 0 && descuento !== "" && precio_venta !== "") {
			if (stock >= cantidad) {

				subtotal[cont] = (cantidad * precio_venta - descuento);
				total = total + subtotal[cont];

				var fila = '<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">X</button></td><td><input type="hidden" name="articulo_id[]" value="'+articulo_id+'">'+articulo_nombre+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td><td><input type="number" name="precio_venta[]" value="'+precio_venta+'"></td><td><input type="number" name="descuento[]" value="'+descuento+'"></td><td>'+subtotal[cont]+'</td></tr>';

				cont++;

				limpiar();

				$("#total").html("$/. "+total);
				$("#total_venta").val(total);

				evaluar();

				$('#detalles').append(fila);
			}else{

				alert('la cantidad a vender supera el stock');
			}
		}else{

			alert("Error al ingresar el detalle de la venta, revise los datos del articulo");
		}
	}

	function limpiar(){
		$("#p_cantidad").val("");
		$("#p_descuento").val("");
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

	function eliminar(index){
		total = total-subtotal[index];
		$("#total").html("$/. "+total);
		$("#total_venta").val(total);
		$("#fila"+index).remove();
		evaluar();
	}


</script>
@endpush	

@endsection