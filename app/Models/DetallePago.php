<?php

namespace App\Models;

use App\Models\Base\DetallePago as BaseDetallePago;

class DetallePago extends BaseDetallePago
{
	protected $fillable = [
		'monto',
		'fecha_hora',
		'reservas_id',
		'metodo_pagos_id'
	];
}
