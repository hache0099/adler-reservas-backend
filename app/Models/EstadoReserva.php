<?php

namespace App\Models;

use App\Models\Base\EstadoReserva as BaseEstadoReserva;

class EstadoReserva extends BaseEstadoReserva
{
	protected $fillable = [
		'descripcion'
	];
}
