<?php

namespace App\Models;

use App\Models\Base\EstadoPago as BaseEstadoPago;

class EstadoPago extends BaseEstadoPago
{
	protected $fillable = [
		'descripcion'
	];
}
