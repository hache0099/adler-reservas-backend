<?php

namespace App\Models;

use App\Models\Base\Socio as BaseSocio;

class Socio extends BaseSocio
{
	protected $fillable = [
		'fecha_alta',
		'estado_membresia_id',
		'users_id'
	];
}
