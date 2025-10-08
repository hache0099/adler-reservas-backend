<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\PagoMembresium;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ConfirmacionPagoEfectivo
 * 
 * @property int $id
 * @property int|null $pago_membresia_id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property PagoMembresium|null $pago_membresium
 * @property User $user
 *
 * @package App\Models\Base
 */
class ConfirmacionPagoEfectivo extends Model
{
	protected $table = 'confirmacion_pago_efectivo';

	protected $casts = [
		'pago_membresia_id' => 'int',
		'user_id' => 'int'
	];

	public function pago_membresium()
	{
		return $this->belongsTo(PagoMembresium::class, 'pago_membresia_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
