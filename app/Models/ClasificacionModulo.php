<?php

namespace App\Models;

use App\Models\Base\ClasificacionModulo as BaseClasificacionModulo;

class ClasificacionModulo extends BaseClasificacionModulo
{
	protected $fillable = [
		'descripcion'
	];
}
