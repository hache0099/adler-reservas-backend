<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\PagoMembresium;
use App\Models\PrecioMembresium;
use App\Models\Socio;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MembresiaMe
 * 
 * @property int $id
 * @property int|null $mes
 * @property int|null $anio
 * @property float|null $monto_a_pagar
 * @property float|null $monto_pagado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $socio_id
 * @property int $precio_membresia_id
 * 
 * @property PrecioMembresium $precio_membresium
 * @property Socio $socio
 * @property Collection|PagoMembresium[] $pago_membresia
 *
 * @package App\Models\Base
 */
class MembresiaMe extends Model
{
	protected $table = 'membresia_mes';

	protected $casts = [
		'mes' => 'int',
		'anio' => 'int',
		'monto_a_pagar' => 'float',
		'monto_pagado' => 'float',
		'socio_id' => 'int',
		'precio_membresia_id' => 'int'
	];

	public function precio_membresium()
	{
		return $this->belongsTo(PrecioMembresium::class, 'precio_membresia_id');
	}

	public function socio()
	{
		return $this->belongsTo(Socio::class);
	}

	public function pago_membresia()
	{
		return $this->hasMany(PagoMembresium::class, 'membresia_mes_id');
	}
}
