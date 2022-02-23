<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PruebaController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return 'Hola!';
    }

    public function test(Request $request)
    {
        $request->session()->put('hola', new \DateTime());
        return 'hey!';
    }
}
