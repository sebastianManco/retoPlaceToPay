<?php

namespace Tests\Feature\Users;

use App\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\User;

class UserTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /**
     * @test
     */
    public function list_Of_Users()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get(route('users.index'));

        $response->assertStatus(200);
        $response->assertViewIs('users.userList');
        $response->assertViewHas('users');

        $responseUsers = $response->getOriginalContent()['users'];
        $responseUsers->each(function($item) use ($user) {
            $this->assertEquals($user->id, $item->id);
        });
    }

    /**
     * marca error en la vista
     * @test
     */
    public function create_a_user()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get(route('users.create'));

        $response->assertStatus(200);

    }


    /**
     * Marca error con request personalizado
     * @test
     */
    public function store_a_user()
    {
        //$this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->post(route('users.store'), [
                'name' => 'cristian',
                'last_name' => 'Manco Valencia',
                'email' => 'crstianManco@example.com',
                'phone' => '3122104498',
                'password' => '123456789'
            ]);
 
        $response->assertRedirect('home/userList');
    }

    /**
     * @test
     */
    public function the_name_is_required()
    {

        $this->from('/users/create')
            ->post('/users/', [
                'name' => '',
                'last_name' => '',
                'email' => 'crstianManco@example.com',
                'phone' => '3122104498',
                'password' => '123456789'
        ])
            ->assertRedirect('/users/create')
            ->assertSessionHasErrors(['name' =>  'El campo es obligatorio']);

        $this->assertEquals(0, User::count());
    }

    /**
     * @test
     */
    public function it_edit_a_user()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get("/users/{$user->id}");

        $response->assertStatus(200);
    }
        /**
         * @test
         */
    public function it_updates_a_user()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $this->put("/users/{$user->id}", [
            'name' => 'Cristian',
            'last_name' => 'Manco Valencia',
            'email' => 'crstianManco@example.com',
            'phone' => '3122104498',
            'estado' => '1',
        'password' => '123456789'
            ])->assertRedirect('home/userList');
        }
}
