<?php

namespace App\Models;

use App\Models\Base\EstadoCancha as BaseEstadoCancha;

class EstadoCancha extends BaseEstadoCancha
{
	protected $fillable = [
		'descripcion'
	];
}
