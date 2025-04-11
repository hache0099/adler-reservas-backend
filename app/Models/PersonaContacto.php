<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PersonaContacto
 * 
 * @property int $id
 * @property string|null $descripcion
 * @property int $persona_id
 * @property int $tipo_contacto_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Persona $persona
 * @property TipoContacto $tipo_contacto
 *
 * @package App\Models
 */
class PersonaContacto extends Model
{
	protected $table = 'persona_contactos';

	protected $casts = [
		'persona_id' => 'int',
		'tipo_contacto_id' => 'int'
	];

	protected $fillable = [
		'descripcion',
		'persona_id',
		'tipo_contacto_id'
	];

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}

	public function tipo_contacto()
	{
		return $this->belongsTo(TipoContacto::class);
	}
}
