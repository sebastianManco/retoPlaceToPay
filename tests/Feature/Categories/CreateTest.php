<?php

namespace Tests\Feature\Categories;

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
    public function aNotAuthenticatedUserCannotCreateACategory()
    {
        $response = $this->get(route('categories.create'));

        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function aAuthenticatedUserCanCreateACategory()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get('/categories');

        $response->assertOk()->assertSee('Nombre');

    }

}
