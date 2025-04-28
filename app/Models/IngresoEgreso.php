<?php

namespace App\Models;

use App\Models\Base\IngresoEgreso as BaseIngresoEgreso;

class IngresoEgreso extends BaseIngresoEgreso
{
	protected $fillable = [
		'tipo_evento',
		'fecha_hora',
		'reserva_id'
	];
}
