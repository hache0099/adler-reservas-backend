<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\ClasificacionModulo;
use App\Models\PerfilModulo;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Modulo
 * 
 * @property int $id
 * @property string|null $descripcion
 * @property string|null $ruta
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $clasificacion_modulos_id
 * 
 * @property ClasificacionModulo|null $clasificacion_modulo
 * @property Collection|PerfilModulo[] $perfil_modulos
 *
 * @package App\Models\Base
 */
class Modulo extends Model
{
	protected $table = 'modulos';

	protected $casts = [
		'clasificacion_modulos_id' => 'int'
	];

	public function clasificacion_modulo()
	{
		return $this->belongsTo(ClasificacionModulo::class, 'clasificacion_modulos_id');
	}

	public function perfil_modulos()
	{
		return $this->hasMany(PerfilModulo::class);
	}
}
