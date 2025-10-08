<?php

namespace App\Models;

use App\Models\Base\MembresiaMe as BaseMembresiaMe;

class MembresiaMe extends BaseMembresiaMe
{
	protected $fillable = [
		'mes',
		'anio',
		'monto_a_pagar',
		'monto_pagado',
		'socio_id',
		'precio_membresia_id'
	];
}
