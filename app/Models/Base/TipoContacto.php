<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\PersonaContacto;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoContacto
 * 
 * @property int $id
 * @property string|null $descripcion
 * @property int|null $obligatorio
 * @property int|null $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|PersonaContacto[] $persona_contactos
 *
 * @package App\Models\Base
 */
class TipoContacto extends Model
{
	protected $table = 'tipo_contactos';

	protected $casts = [
		'obligatorio' => 'int',
		'estado' => 'int'
	];

	public function persona_contactos()
	{
		return $this->hasMany(PersonaContacto::class);
	}
}
