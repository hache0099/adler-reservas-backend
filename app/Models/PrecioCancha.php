<?php

namespace App\Models;

use App\Models\Base\PrecioCancha as BasePrecioCancha;

class PrecioCancha extends BasePrecioCancha
{
	protected $fillable = [
		'precio',
		'fecha_inicio',
		'fecha_fin',
		'cancha_id'
	];
}
