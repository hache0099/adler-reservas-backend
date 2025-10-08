<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\ConfirmacionPagoEfectivo;
use App\Models\MedioPagoMembresium;
use App\Models\MembresiaMe;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PagoMembresium
 * 
 * @property int $id
 * @property Carbon|null $fecha
 * @property float|null $monto
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $membresia_mes_id
 * @property int $medio_pago_membresia_id
 * 
 * @property MedioPagoMembresium $medio_pago_membresium
 * @property MembresiaMe $membresia_me
 * @property Collection|ConfirmacionPagoEfectivo[] $confirmacion_pago_efectivos
 *
 * @package App\Models\Base
 */
class PagoMembresium extends Model
{
	protected $table = 'pago_membresia';

	protected $casts = [
		'fecha' => 'datetime',
		'monto' => 'float',
		'membresia_mes_id' => 'int',
		'medio_pago_membresia_id' => 'int'
	];

	public function medio_pago_membresium()
	{
		return $this->belongsTo(MedioPagoMembresium::class, 'medio_pago_membresia_id');
	}

	public function membresia_me()
	{
		return $this->belongsTo(MembresiaMe::class, 'membresia_mes_id');
	}

	public function confirmacion()
	{
		return $this->hasMany(ConfirmacionPagoEfectivo::class, 'pago_membresia_id');
	}
}
