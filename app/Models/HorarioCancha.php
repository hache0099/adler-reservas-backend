<?php

namespace App\Models;

use App\Models\Base\HorarioCancha as BaseHorarioCancha;

class HorarioCancha extends BaseHorarioCancha
{
	protected $fillable = [
		'hora_desde',
		'hora_hasta',
		'cancha_id'
	];
}
