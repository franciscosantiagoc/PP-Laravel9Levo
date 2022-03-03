<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class Service
{
    public function consulta(): Collection
    {
        $data = Cache::has('catalogo')
            ? Cache::get('catalogo')
            : $this->cacheData();

        return $data;
    }

    public function getName(string $id): string
    {
        $collection = $this->consulta();
        $name = $collection
            ->first(function ($value, $key) use($id) {
                return $value['id'] === $id;
            });

        return $name['descripcion'];
    }

    public function cacheData(): Collection
    {
        $data = $this->getCatalogo();
        Cache::put('catalogo', $data, now()->addDay());
        return $data;
    }

    public function getCatalogo(): Collection
    {
        $urlCatalogo = 'https://api.kuspit.com/OpenKuspit/api/v1/catalogos/procedencia';

        $response = Http::withHeaders([
            'Accept' => 'application/json;charset=utf-8'
        ])->get($urlCatalogo);

        return $response->collect();
    }
}
