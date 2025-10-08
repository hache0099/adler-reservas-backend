<?php

namespace App\Models;

use App\Models\Base\EstadoMembresium as BaseEstadoMembresium;

class EstadoMembresium extends BaseEstadoMembresium
{
	protected $fillable = [
		'descripcion'
	];
}
