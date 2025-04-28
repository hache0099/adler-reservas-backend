<?php

namespace App\Models;

use App\Models\Base\PorcentajeSena as BasePorcentajeSena;

class PorcentajeSena extends BasePorcentajeSena
{
	protected $fillable = [
		'porcentaje',
		'fecha_desde',
		'fecha_hasta'
	];
}
