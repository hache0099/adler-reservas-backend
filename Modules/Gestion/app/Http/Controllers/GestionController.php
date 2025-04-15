<?php

namespace Modules\Gestion\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\{TipoDocumento, TipoContacto, TipoDomicilio};

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
}
