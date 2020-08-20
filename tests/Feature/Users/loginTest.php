<?php

namespace Tests\Feature\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Role;

class loginTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Iniciar sesión muestra el formulario de inicio de sesión
     * 200 = ok, solicitud ha tenido exito.
     *@test
     */
    public function login_displays_the_login_form()
    {
        $response = $this->get(route('login'));
        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    /**
     *  El inicio de sesión muestra errores de validación
     *  302 = URI solicitada ha sido cambiado temporalmente
     * @test
     */
    public function login_displays_validation_errors()
    {
        $response = $this->post(route('login'), []);
        $response->assertStatus(302);
        $response->assertSessionHasErrors('email');
    }

    /**
     * El inicio de sesión autenticada y redirige al usuario
     * @test
     */
    public function login_authenticates_and_redirects_user()
    {
        $user = factory(User::class)->create();

        $response = $this->post(route('login'),[
            'email' => 'sebastian@example.com',
            'password' =>  'password'
        ]
        );
        $this->assertAuthenticated($guard = null);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('home'));
    }

    /** @test */
    public function it_visit_page_of_login()
    {
        $this->get('/login')
            ->assertStatus(200);
    }

    /** @test */
    public function authenticated_to_a_user()
    {
        factory(User::class)->create([
            "email" => "user@mail.com"
        ]);

        $this->get('/login');
        $credentials = [
            "email" => "user@mail.com",
            "password" => "password"
        ];

        $response = $this->post('/login', $credentials);
        $response->assertRedirect('/home');
        $this->assertCredentials($credentials);
    }
}
