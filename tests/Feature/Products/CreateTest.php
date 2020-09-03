<?php

namespace Tests\Feature\Products;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function anNotAuthenticatedUserCannotAccessToCreateViewOfProducts()
    {
        $response = $this->get(route('categories.index'));

        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function anAuthenticatedUserCanAccessToCreateViewOfProducts()
    {
            $user = factory(User::class)->create();

            $response = $this->actingAs($user)
                ->get(route('products.create'));

            $response->assertOk()->assertSee('Nombre')
                ->assertSee('Descripción')
                ->assertSee('Categorias')
                ->assertSee('Precio')
                ->assertSee('Imagen')
                ->assertSee('Cantidad');

    }
}
