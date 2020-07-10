@extends('layouts.admin')

@section('contenido')

	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Articulo</h3>
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
			{!! Form::open(['url' => '/almacen/articulo', 'method' => 'POST', 'autocomplete' => 'off', 'files' => 'true']) !!}

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
				<label>Categoria</label>
				<select name="categoria_id" class="form-control">
					@foreach($categorias as $cat)
						<option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="codigo">Codigo</label>
				<input type="text" name="codigo" placeholder="Codigo del Articulo" class="form-control" required value="{{ old('codigo') }}">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="stock">Stock</label>
				<input type="text" name="stock" placeholder="Stock del Articulo" class="form-control" required value="{{ old('stock') }}">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="descripcion">Descripcion</label>
				<input type="text" name="descripcion" placeholder="Descripcion" class="form-control" placeholder="Descripcion del Articulo" value="{{ old('descripcion') }}">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="imagen">Imagen</label>
				<input type="file" name="imagen" class="form-control" >
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