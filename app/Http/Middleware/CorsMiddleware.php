<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CorsMiddleware
{
     /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Intercepta la petición OPTIONS (pre-flight)
        if ($request->isMethod('OPTIONS')) {
            // Para las peticiones pre-flight, solo necesitamos devolver las cabeceras
            // con un código 200 OK.
            $response = response('', 200);
        } else {
            // Para otras peticiones, permite que la aplicación las maneje
            // y luego modificaremos la respuesta.
            $response = $next($request);
        }

        // Añade las cabeceras CORS a la respuesta
        $response->header('Access-Control-Allow-Origin', env('FRONTEND_URL', 'http://localhost:5173'));
        $response->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        $response->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With, Accept');
        $response->header('Access-Control-Allow-Credentials', 'true');

        return $response;
    }
}
