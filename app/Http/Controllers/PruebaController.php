<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PruebaRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class PruebaController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(PruebaRequest $request)
    {
        // devolver un saludo al usuario (con clave name en el request)
        // solo si pasó la validación (procedencia en catalogo de Kuspit)
        return 'Hola!';
    }

    public function catalogo(Request $request)
    {
        $urlCatalogo = 'https://api.kuspit.com/OpenKuspit/api/v1/catalogos/procedencia';
        $response = Http::get($urlCatalogo);
        //dd($response);//Dump & Die debugueo data
        return $response->body();
    }

    public function test(Request $request)
    {
        $fecha_cacheada = Cache::has('cached_date')
            ? Cache::get('cached_date')
            : $this->cacheDate();
        
        return response()->json([
            'fecha_cacheada' => $fecha_cacheada,
            'fecha_actual' => new \DateTime(),
        ]);
    }

    protected function cacheDate(): \DateTime
    {
        $new_fecha = new \DateTime();
        Cache::put('cached_date', $new_fecha, now()->addMinutes(1));
        return $new_fecha;
    }
}
