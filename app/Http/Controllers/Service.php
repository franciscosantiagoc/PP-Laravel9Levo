<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class Service
{
    public function consulta(): array
    {
        $urlCatalogo = 'https://api.kuspit.com/OpenKuspit/api/v1/catalogos/procedencia';

        $response = Http::withHeaders([
            'Accept' => 'application/json;charset=utf-8'
        ])->get($urlCatalogo);

        return json_decode($response->body());
    }

    public function getName(string $id): string
    {
        $data = $this->consulta();
        $collection = collect($data);
        $name = $collection
            ->first(function ($value, $key) use($id) {
                return $value->id === $id;
            });
        //dd($name);
            //->pluck('descripcion');
        return $name->descripcion;
    }
}
