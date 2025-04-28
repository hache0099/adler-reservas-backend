<?php

namespace App\Models;

use App\Models\Base\DiasNoDisponible as BaseDiasNoDisponible;

class DiasNoDisponible extends BaseDiasNoDisponible
{
	protected $fillable = [
		'desde',
		'hasta',
		'cancha_id'
	];
}
