<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MetodoPago
 * 
 * @property int $id
 * @property string|null $descripcion
 * @property int|null $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models\Base
 */
class MetodoPago extends Model
{
	protected $table = 'metodo_pagos';

	protected $casts = [
		'estado' => 'int'
	];
}
