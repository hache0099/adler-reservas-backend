<?php

namespace App\Models;

use App\Models\Base\TipoCancha as BaseTipoCancha;

class TipoCancha extends BaseTipoCancha
{
	protected $fillable = [
		'material',
		'estado'
	];
}
