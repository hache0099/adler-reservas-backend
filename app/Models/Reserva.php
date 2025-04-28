<?php

namespace App\Models;

use App\Models\Base\Reserva as BaseReserva;

class Reserva extends BaseReserva
{
	protected $fillable = [
		'fecha',
		'hora',
		'monto_total',
		'monto_pagado',
		'estado_reserva_id',
		'user_id',
		'cancha_id',
		'estado_pago_id',
		'porcentaje_sena_id'
	];
}
