<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\PagoMembresium;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MedioPagoMembresium
 * 
 * @property int $id
 * @property string|null $descripcion
 * @property int|null $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|PagoMembresium[] $pago_membresia
 *
 * @package App\Models\Base
 */
class MedioPagoMembresium extends Model
{
	protected $table = 'medio_pago_membresia';

	protected $casts = [
		'estado' => 'int'
	];

	public function pago_membresia()
	{
		return $this->hasMany(PagoMembresium::class, 'medio_pago_membresia_id');
	}
}
