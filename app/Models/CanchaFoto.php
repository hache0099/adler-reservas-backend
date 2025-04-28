<?php

namespace App\Models;

use App\Models\Base\CanchaFoto as BaseCanchaFoto;

class CanchaFoto extends BaseCanchaFoto
{
	protected $fillable = [
		'ruta',
		'principal',
		'cancha_id'
	];
}
