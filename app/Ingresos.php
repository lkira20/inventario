<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingresos extends Model
{
    //
	protected $table = 'ingresos';

    protected $fillable= [

		'persona_id',
		'tipo_comprobante',
		'serie_comprobante',
		'num_comprobante',
		'fecha_hora',
		'impuesto',
		'estado'
	];

	public function persona(){

		return $this->belongsTo('App\Persona');
	}


	public function articulos(){

		return $this->belongsToMany('App\Articulo', 'articulo_ingreso', 'ingreso_id')->using('App\articulo_ingreso')->withPivot('cantidad', 'precio_compra', 'precio_venta');
	}

}
