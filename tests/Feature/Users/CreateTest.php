<?php

namespace Tests\Feature\users;

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
    public function aNotAuthenticatedCannotCreateAUser()
    {
        $response = $this->get(route('users.create'));

        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function anAuthenticatedUserCanAccessToCreateViewOfUser()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get(route('users.create'));

        $response->assertOk()
            ->assertSee('Nombre')
            ->assertSee('Apellido')
            ->assertSee('Correo electrónico')
            ->assertSee('Número de teléfono')
            ->assertSee('Contraseña')
            ->assertSee('Comfirme contraseña');


    }
}
