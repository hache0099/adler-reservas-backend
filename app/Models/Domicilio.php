<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Domicilio
 * 
 * @property int $id
 * @property string|null $detalle
 * @property int $persona_id
 * @property int $tipo_domicilio_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Persona $persona
 * @property TipoDomicilio $tipo_domicilio
 *
 * @package App\Models
 */
class Domicilio extends Model
{
	protected $table = 'domicilios';

	protected $casts = [
		'persona_id' => 'int',
		'tipo_domicilio_id' => 'int'
	];

	protected $fillable = [
		'detalle',
		'persona_id',
		'tipo_domicilio_id'
	];

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}

	public function tipo_domicilio()
	{
		return $this->belongsTo(TipoDomicilio::class);
	}
}
