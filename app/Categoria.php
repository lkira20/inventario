<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
//  protected $table = 'Categorias'; // para hacer referencia a la tabla

//	protected $primaryKey = 'id' //referencia a la clave primaria

//	public $timestamps = false; // referencia a las fechas de creado y actualizado

	protected $fillable= [

		'nombre',
		'descripcion',
		'condicion',
	];

	/*protected $guarded = [//los campos que no queremos crear masivamente en el modelo


	]*/
}
