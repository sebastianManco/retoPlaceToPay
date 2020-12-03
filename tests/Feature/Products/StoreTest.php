<?php

namespace Tests\Feature\Products;

use App\Category;
use App\Product;
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
        factory(Category::class)->create();
        $product = factory(Product::class)->make()->toArray();

        $response = $this->actingAs($user)
            ->post(route('products.store'), $product)->dump();

            $this->assertCredentials([
                'name' => 'Redmi note 8',
                'description' => 'Esta es la descripcion del celular',
                'price' => '850000',
                'stock' => '10'
            ]);
    }
}
