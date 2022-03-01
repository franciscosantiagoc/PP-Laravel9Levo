<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class CatalogoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/helo');

        $response->assertStatus(
            Response::HTTP_NOT_FOUND
        );
    }

    /**
     * @group valid
     */
    public function test_catalogo()
    {
        $response = $this->get('/api/catalogo');
        $response
            ->assertOk()
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'descripcion',
                ],
            ]);
    }

    /**
     * @group validaciones
     */
    public function test_invalid()
    {
        $response = $this->getJson('api/helo?name=Franc&procedencia=6');
        $response
            ->assertStatus(
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
    }



    /**
     * @group validaciones
     */
    public function test_valid()
    {
        $response = $this->getJson('api/helo?name=Franc&procedencia=4');
        $response
            ->assertOk()
            ->assertSee('VENTAS');
    }
}
