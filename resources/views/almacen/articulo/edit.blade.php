@extends('layouts.admin')

@section('contenido')

	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar articulo {{ $articulo->nombre }}</h3>
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
			{!! Form::model($articulo, ['method' => 'PATCH', 'action' => ['ArticuloController@update', $articulo],'files' => true ]) !!}

			{!! Form::token(); !!}

			<div class="row">
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" placeholder="Nombre" class="form-control" required value="{{ $articulo->nombre }}">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label>Categoria</label>
				<select name="categoria_id" class="form-control">
					@foreach($categorias as $cat)
						@if($cat->id == $articulo->categoria->id)
							<option value="{{ $cat->id }}" selected>{{ $cat->nombre }}</option>
							@else
							<option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
						@endif
					@endforeach
				</select>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="codigo">Codigo</label>
				<input type="text" name="codigo" class="form-control" required value="{{ $articulo->codigo }}">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="stock">Stock</label>
				<input type="text" name="stock" class="form-control" required value="{{ $articulo->stock }}">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="descripcion">Descripcion</label>
				<input type="text" name="descripcion" placeholder="Descripcion" class="form-control" placeholder="Descripcion del Articulo" value="{{ $articulo->descripcion }}">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="imagen">Imagen</label>
				<input type="file" name="imagen" class="form-control" >
				@if($articulo->imagen !== "")
					<img src="{{ asset('/images/articulos/'.$articulo->imagen) }}" alt="{{ $articulo->nombre }}" width="100%" height="300px" class="img thumbnail">
				@endif
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<select name="estado" class="form-control" value="{{ $articulo->estado }}">						<option value="Activo">Activo</option>
				<option value="Inactivo">Activo</option>
			</select>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Agregar</button>
				<button class="btn btn-danger" type="reset">Borrar Campos</button>
			</div>
		</div>	


			{!! Form::close() !!}
		</div>
	

@endsection