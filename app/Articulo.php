<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    //
    protected $fillable= [

    	'categoria',
    	'codigo',
		'nombre',
		'stock',
		'descripcion',
		'imagen',
		'estado',
	];

	public function categoria(){

		return $this->belongsTo('App\Categoria');
	}

	public function ingreso(){

		return $this->belongsToMany('App\Ingresos', 'articulo_ingreso', 'articulo_id', 'ingreso_id')->withPivot('cantidad', 'precio_compra', 'precio_venta');
	}

	public function venta(){

		return $this->belongsToMany('App\Venta', 'articulo_venta')->withPivot('cantidad', 'precio_venta', 'descuento');
	}
}
