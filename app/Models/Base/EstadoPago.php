<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Reserva;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EstadoPago
 * 
 * @property int $id
 * @property string|null $descripcion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Reserva[] $reservas
 *
 * @package App\Models\Base
 */
class EstadoPago extends Model
{
	protected $table = 'estado_pagos';

	public function reservas()
	{
		return $this->hasMany(Reserva::class);
	}
}
