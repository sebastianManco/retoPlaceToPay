<?php

namespace Tests\Feature\Products;

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
        $response = $this->get(route('products.index'));

        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function anAuthenticatedUserCannotAccessTheEditPath()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get(route('products.Edit'));

        $response->assertRedirect(route('login'));
    }
}
