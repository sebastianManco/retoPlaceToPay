<?php

namespace Tests\Feature\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\User;
use App\Role;

class loginTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function loginDisplaysTheLoginForm()
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    /**
     * @test
     */
    public function anRegisteredUserCanLogIn()
    {
        factory(User::class)->create([
            'email' => 'sebastian@example.com'
        ]);

        $response = $this->post(route('login'),[
            'email' => 'sebastian@example.com',
            'password' =>  'password'
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('home'));
    }

    /**
     * @test
     */
    public function AnUnregisteredUserCannotLogIn()
    {
        factory(User::class)->create([
            'email' => 'sebastian@example.com'
        ]);

        $response = $this->post(route('login'),[
            'email' => 'cristian@example.com',
            'password' =>  'password'
        ]);

        $response->assertRedirect('/');
        $response->assertSessionHasErrors('email');
    }

    /**
     * @test
     */
    public function thePasswordDoesNotMatchWithTheEmailCannotLonIn()
    {
        factory(User::class)->create([
            'email' => 'sebastian@example.com'
        ]);

        $response = $this->post(route('login'),[
            'email' => 'sebastian@example.com',
            'password' =>  'incorrect password'
        ]);

        $response->assertRedirect('/');
        $response->assertSessionHasErrors('email');
    }


    /**
     * @test
     */
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
