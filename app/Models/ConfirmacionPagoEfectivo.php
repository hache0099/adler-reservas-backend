<?php

namespace App\Models;

use App\Models\Base\ConfirmacionPagoEfectivo as BaseConfirmacionPagoEfectivo;

class ConfirmacionPagoEfectivo extends BaseConfirmacionPagoEfectivo
{
	protected $fillable = [
		'pago_membresia_id',
		'user_id'
	];
}
