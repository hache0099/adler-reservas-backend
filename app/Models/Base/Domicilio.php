<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Persona;
use App\Models\TipoDomicilio;
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
 * @package App\Models\Base
 */
class Domicilio extends Model
{
	protected $table = 'domicilios';

	protected $casts = [
		'persona_id' => 'int',
		'tipo_domicilio_id' => 'int'
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
