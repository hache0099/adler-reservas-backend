<?php

namespace App\Models;

use App\Models\Base\MedioPagoMembresium as BaseMedioPagoMembresium;

class MedioPagoMembresium extends BaseMedioPagoMembresium
{
	protected $fillable = [
		'descripcion',
		'estado',
	];
}
