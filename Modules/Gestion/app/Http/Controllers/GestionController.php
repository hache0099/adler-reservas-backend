<?php

namespace Modules\Gestion\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\{Modulo, TipoDocumento, TipoContacto, TipoDomicilio, TipoCancha};

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

    public function getModulos(){
        $rechazados = [
            'gestion indice',
            'gestion socios',
            'gestion de fotos de canchas',
            'gestion horarios de canchas',   
            'gestion de empleados',
        ];
        return Modulo::where('ruta','like','/gestion/%')
        ->get(['id', 'descripcion', 'ruta'])
        ->reject(function ($modulo) use ($rechazados){
            return in_array(strtolower($modulo->descripcion), $rechazados);
        });
    }

    public function getAllModulos(){
        return Modulo::get(['id', 'descripcion', 'ruta']);
    }
}
