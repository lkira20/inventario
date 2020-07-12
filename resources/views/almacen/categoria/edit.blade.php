@extends('layouts.admin')

@section('contenido')

	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Categoria {{ $categoria->nombre }}</h3>
			@if(count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
					@foreach($errors->all() as $error)	
						<li>{{ $error }}</li>
					@endforeach	
					</ul>
				</div>
			@endif

			{!! Form::model($categoria, ['method' => 'PATCH', 'action' => ['CategoriaController@update', $categoria] ]) !!}

			{!! Form::token(); !!}

			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" placeholder="Nombre" class="form-control" value="{{ $categoria->nombre }}">
			</div>
			<div class="form-group">
				<label for="descripcion">Descripcion</label>
				<input type="text" name="descripcion" placeholder="Descripcion" class="form-control" value="{{ $categoria->descripcion }}">
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Agregar</button>
			</div>
			<div class="form-group">
				<button class="btn btn-danger" type="reset">Borrar Campos</button>
			</div>
			

			{!! Form::close() !!}
		</div>
	</div>

@endsection