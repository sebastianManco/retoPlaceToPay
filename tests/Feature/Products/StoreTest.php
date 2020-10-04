<?php

namespace Tests\Feature\Products;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function aNotAuthenticatedCannotStoreAProduct()
    {
        $response = $this->get(route('products.store'));

        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function aAuthenticatedCannotStoreAProduct()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get(route('products.store'), [
                'name' => 'Redmi note 8',
                'description' => 'Esta es la descripcion del celular',
                'price' => '850000',
                'stock' => '10'
                ]);

            $response->assertRedirect('/products');

            $this->assertCredentials([
                'name' => 'Redmi note 8',
                'description' => 'Esta es la descripcion del celular',
                'price' => '850000',
                'stock' => '10'
            ]);
    }
}
