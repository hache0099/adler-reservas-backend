<?php

namespace Modules\Gestion\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\{Modulo, Perfile, TipoDocumento, TipoContacto, TipoDomicilio, TipoCancha, ClasificacionModulo};

class GestionController extends Controller
{
    public function getTiposContacto()
    {
        return TipoContacto::where('estado', 1)->get(['id', 'descripcion']);
    }

    public function getTiposDocumento()
    {
        return TipoDocumento::where('estado', 1)->get(['id', 'descripcion']);
    }

    public function getTiposDomicilio()
    {
        return TipoDomicilio::where('estado', 1)->get(['id', 'descripcion']);
    }

    public function getTiposCancha()
    {
        return TipoCancha::where('estado', 1)->get(['id', 'material']);
    }
	
	public function getClasificacionModulos()
	{
		return ClasificacionModulo::all();
	}
	

    public function getModulos(){
        $rechazados = [
            'gestion indice',
            //'gestion socios',
            'gestion de fotos de canchas',
            'gestion de horarios de canchas',   
            'gestion de empleados',
            'gestion de ingresos y egresos'
        ];
        return Modulo::where('ruta','like','/gestion/%')
		->with('clasificacion_modulo')
        ->get(['id', 'descripcion', 'ruta', 'clasificacion_modulos_id',])
        ->reject(function ($modulo) use ($rechazados){
            return in_array(strtolower($modulo->descripcion), $rechazados);
        });
    }

    public function getAllModulos(){
        return Modulo::get(['id', 'descripcion', 'ruta']);
    }

    public function getPerfiles()
    {
        return Perfile::all();
    }
}
