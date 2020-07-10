@extends('layouts.admin')

@section('contenido')

	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar cliente {{ $persona->nombre }}</h3>
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
			{!! Form::model($persona, ['method' => 'PATCH', 'action' => ['ClienteController@update', $persona]]) !!}

			{!! Form::token(); !!}

	<div class="row">
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" placeholder="Nombre" class="form-control" required value="{{ $persona->nombre }}">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="direccion">Direccion</label>
				<input type="text" name="direccion" placeholder="Direccion" class="form-control" value="{{ $persona->direccion }}">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label>Documento</label>
				<select name="tipo_documento" class="form-control">
					@if( $persona->tipo_documento == 'DNI')
						<option value="DNI" selected>DNI</option>
						<option value="RUC">RUC</option>
						<option value="PAS">PAS</option>
						@elseif($persona->tipo_documento == 'RUC')
							<option value="DNI">DNI</option>
							<option value="RUC" selected>RUC</option>
							<option value="PAS">PAS</option>
						@else
						<option value="DNI">DNI</option>
						<option value="RUC">RUC</option>
						<option value="PAS" selected>PAS</option>
					@endif
				</select>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="num_documento">Numero documento</label>
				<input type="text" name="num_documento" placeholder="Numero de documento" class="form-control" value="{{ $persona->num_documento }}">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="telefono">Telefono</label>
				<input type="text" name="telefono" placeholder="Telefono" class="form-control" value="{{ $persona->num_documento }}">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" name="email" placeholder="Email" class="form-control" value="{{ $persona->email }}">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Borrar Campos</button>
			</div>
		</div>	
	</div>

			{!! Form::close() !!}
	

@endsection