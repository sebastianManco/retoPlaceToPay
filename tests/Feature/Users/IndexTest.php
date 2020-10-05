<?php

namespace Tests\Feature\Users;

use App\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\User;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function aNotAuthenticatedUSerCannotAccessTheUserList()
    {
        $response = $this->get(route('users.index'));

        $response->assertRedirect(route('login'));
    }
    /**
     * @test
     */
    public function aAuthenticatedUSerCanAccessTheUserList()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get(route('users.index'));

        $response->assertStatus(200);
        $response->assertViewIs('users.userList');
        $response->assertViewHas('users');

        $responseUsers = $response->getOriginalContent()['users'];
        $responseUsers->each(function ($item) use ($user) {
            $this->assertEquals($user->id, $item->id);
        });
    }
}
