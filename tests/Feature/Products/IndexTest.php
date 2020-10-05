<?php

namespace Tests\Feature\Products;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function aNotAuthenticatedUserCannotSeeTheIndexOfProducts()
    {
        $response = $this->get(route('products.index'));

        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function aAuthenticatedUserCanSeeTheIndexOfProducts()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
        ->get(route('products.index'));

        $response->assertOk();
    }

}
