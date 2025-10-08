<?php

namespace App\Models;

use App\Models\Base\PagoMembresium as BasePagoMembresium;

class PagoMembresium extends BasePagoMembresium
{
	protected $fillable = [
		'fecha',
		'monto',
		'membresia_mes_id',
		'medio_pago_membresia_id'
	];
}
