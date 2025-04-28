<?php

namespace App\Models;

use App\Models\Base\Cancha as BaseCancha;

class Cancha extends BaseCancha
{
	protected $fillable = [
		'max_personas',
		'tipo_cancha_id',
		'estado_cancha_id'
	];
}
