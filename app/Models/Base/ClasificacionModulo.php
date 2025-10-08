<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Modulo;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ClasificacionModulo
 * 
 * @property int $id
 * @property string|null $descripcion
 * 
 * @property Collection|Modulo[] $modulos
 *
 * @package App\Models\Base
 */
class ClasificacionModulo extends Model
{
	protected $table = 'clasificacion_modulos';
	public $timestamps = false;

	public function modulos()
	{
		return $this->hasMany(Modulo::class, 'clasificacion_modulos_id');
	}
}
