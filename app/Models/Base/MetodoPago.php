<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\DetallePago;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
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
 * @property Collection|DetallePago[] $detalle_pagos
 *
 * @package App\Models\Base
 */
class MetodoPago extends Model
{
	protected $table = 'metodo_pagos';

	protected $casts = [
		'estado' => 'int'
	];

	public function detalle_pagos()
	{
		return $this->hasMany(DetallePago::class, 'metodo_pagos_id');
	}
}
