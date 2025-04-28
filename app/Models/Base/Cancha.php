<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\CanchaFoto;
use App\Models\DiasNoDisponible;
use App\Models\EstadoCancha;
use App\Models\HorarioCancha;
use App\Models\PrecioCancha;
use App\Models\Reserva;
use App\Models\TipoCancha;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cancha
 * 
 * @property int $id
 * @property int|null $max_personas
 * @property int $tipo_cancha_id
 * @property int $estado_cancha_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property EstadoCancha $estado_cancha
 * @property TipoCancha $tipo_cancha
 * @property Collection|CanchaFoto[] $cancha_fotos
 * @property Collection|DiasNoDisponible[] $dias_no_disponibles
 * @property Collection|HorarioCancha[] $horario_canchas
 * @property Collection|PrecioCancha[] $precio_canchas
 * @property Collection|Reserva[] $reservas
 *
 * @package App\Models\Base
 */
class Cancha extends Model
{
	protected $table = 'canchas';

	protected $casts = [
		'max_personas' => 'int',
		'tipo_cancha_id' => 'int',
		'estado_cancha_id' => 'int'
	];

	public function estado_cancha()
	{
		return $this->belongsTo(EstadoCancha::class);
	}

	public function tipo_cancha()
	{
		return $this->belongsTo(TipoCancha::class);
	}

	public function cancha_fotos()
	{
		return $this->hasMany(CanchaFoto::class);
	}

	public function dias_no_disponibles()
	{
		return $this->hasMany(DiasNoDisponible::class);
	}

	public function horario_canchas()
	{
		return $this->hasOne(HorarioCancha::class);
	}

	public function precio_canchas()
	{
		return $this->hasMany(PrecioCancha::class);
	}

	public function reservas()
	{
		return $this->hasMany(Reserva::class);
	}

	public function precioActual()
	{
		return $this->hasOne(PrecioCancha::class)->latest('fecha_inicio');
	}
}
