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
    public function __invoke(Service $service, PruebaRequest $request)
    {
        /** @var string $name */
        $name = $service->getName($request->validated('procedencia'));

        return $name;
    }

    public function catalogo(Service $service)
    {
        return response()->json($service->consulta());
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
