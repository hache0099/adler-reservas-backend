<?php

namespace App\Models;

use App\Models\Base\PrecioMembresium as BasePrecioMembresium;

class PrecioMembresium extends BasePrecioMembresium
{
	protected $fillable = [
		'precio',
		'fecha_desde',
		'fecha_hasta'
	];
}
