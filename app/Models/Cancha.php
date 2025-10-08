<?php

namespace App\Models;
use App\Models\PrecioCancha;
use App\Models\Base\Cancha as BaseCancha;

class Cancha extends BaseCancha
{
	protected $fillable = [
		'max_personas',
		'tipo_cancha_id',
		'estado_cancha_id',
		'ubicacion_descripcion',
        'latitud',
        'longitud',
	];
	
	public function precio_actual()
	{
		return $this->hasOne(PrecioCancha::class)->latest();
	}
}
