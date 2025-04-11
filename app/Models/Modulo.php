<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

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
 * 
 * @property Collection|PerfilModulo[] $perfil_modulos
 *
 * @package App\Models
 */
class Modulo extends Model
{
	protected $table = 'modulos';

	protected $fillable = [
		'descripcion',
		'ruta'
	];

	public function perfil_modulos()
	{
		return $this->hasMany(PerfilModulo::class);
	}
}
