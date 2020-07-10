<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    //
        protected $fillable= [

		'persona_id',
		'tipo_comprobante',
		'serie_comprobante',
		'num_comprobante',
		'fecha_hora',
		'impuesto',
		'total_venta',
		'estado'
	];
	public function persona(){

		return $this->belongsTo('App\Persona');
	}

	public function articulos(){

		return $this->belongsToMany('App\Articulo', 'articulo_venta')->using('App\articulo_venta')->withPivot('cantidad', 'precio_venta', 'descuento');
	}
}
