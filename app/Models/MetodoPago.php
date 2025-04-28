<?php

namespace App\Models;

use App\Models\Base\MetodoPago as BaseMetodoPago;

class MetodoPago extends BaseMetodoPago
{
	protected $fillable = [
		'descripcion',
		'estado'
	];
}
