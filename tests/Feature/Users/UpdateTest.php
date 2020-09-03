<?php

namespace Tests\Feature\Users;

use App\Role;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function aNotAuthenticatedUserCannotUpdateAUser()
    {
        $user = factory(User::class)->create();

        $response = $this->put(route('users.update', $user))
            ->assertRedirect('login');
    }

    /**
     * @test
     */
    public function anAuthenticatedUserCanAccessToUpdateView()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $userA = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->put(route('users.update', $userA), [
            'name' => 'Cristian',
            'last_name' => 'Manco Valencia',
            'email' => 'crstianManco@example.com',
            'phone' => '3122104498',
            'estado' => '1',
            'password' => '123456789'
        ]);

        $userA = $userA->refresh();
        $this->assertEquals('Cristian', $userA->name);
        $this->assertEquals('Manco Valencia', $userA->last_name);
        $this->assertEquals('crstianManco@example.com', $userA->email);
        $this->assertEquals('3122104498', $userA->phone);
        $this->assertEquals('1', $userA->estado);
        $this->assertTrue(Hash::check('123456789', $userA->password));
        $response->assertRedirect('home/userList');
        //

    }
}

