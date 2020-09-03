<?php

namespace Tests\Feature\Users;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function aNotAuthenticatedUserCannotShowViewAUser()
    {
        $user = factory(User::class)->create();

        $response = $this->get(("/users/{$user->id}"))
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function aAuthenticatedUserCanShowViewAUser()
    {
        $user = factory(User::class)->create();
        $userA = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get(route('users.show', $userA));

        $response->assertStatus(200);
        $response->assertViewIs('users.details');
    }
}
