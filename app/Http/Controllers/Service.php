<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class Service
{
    public function consulta(){
        $urlCatalogo = 'https://api.kuspit.com/OpenKuspit/api/v1/catalogos/procedencia';
        $response = Http::withHeaders([
            'Accept' => 'application/json;charset=utf-8'
        ])->get($urlCatalogo);
        return json_decode($response->body());
    }
}
