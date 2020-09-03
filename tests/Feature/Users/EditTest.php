<?php

namespace Tests\Feature\Users;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EditTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function anNotAuthenticatedUserCannotAccessTheEditPath()
    {
        $user = factory(User::class)->create();

        $response = $this->get(("/users/{$user->id}"))
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function anAuthenticatedUserCanAccessTheEditPath()
    {
        $user = factory(User::class)->create();
        $userA = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get(route('users.edit', $userA));

        $response->assertStatus(200);
        $response->assertViewIs('users.edit');
    }
}
