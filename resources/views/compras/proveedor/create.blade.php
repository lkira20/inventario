@extends('layouts.admin')

@section('contenido')

	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Proveedor</h3>
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
			{!! Form::open(['url' => '/compras/proveedor', 'method' => 'POST', 'autocomplete' => 'off']) !!}

			{!! Form::token(); !!}
	<div class="row">
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" placeholder="Nombre" class="form-control" required value="{{ old('nombre') }}">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="direccion">Direccion</label>
				<input type="text" name="direccion" placeholder="Direccion" class="form-control" value="{{ old('direccion') }}">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label>Documento</label>
				<select name="tipo_documento" class="form-control">
						<option value="DNI">DNI</option>
						<option value="RUC">RUC</option>
						<option value="PAS">PAS</option>
				</select>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="num_documento">Numero documento</label>
				<input type="text" name="num_documento" placeholder="Numero de documento" class="form-control" value="{{ old('num_documento') }}">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="telefono">Telefono</label>
				<input type="text" name="telefono" placeholder="Telefono" class="form-control" value="{{ old('telefono') }}">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" name="email" placeholder="Email" class="form-control" value="{{ old('email') }}">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Agregar</button>
				<button class="btn btn-danger" type="reset">Borrar Campos</button>
			</div>
		</div>	
	</div>	
			{!! Form::close() !!}
	

@endsection