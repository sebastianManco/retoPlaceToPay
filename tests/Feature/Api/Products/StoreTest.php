<?php

namespace Tests\Feature\Api\Products;

use App\Category;
use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use refreshDatabase;



    /**
     * @test
     */
    public function createNewProduct()
    {
        $this->withoutExceptionHandling();
        factory(User::class)->create();
        factory(Category::class)->create();

        $product = [
            'name' => 'Hola',
            'category_id' => 1,
            'description' => 'Esta es la descripcion del producto',
            'price' => 150000,
            'stock' => 12
        ];
        $response = $this->postJson(route('api.products.store'), $product);

        $response->assertSuccessful()
            ->assertHeader('content-type', 'application/json');

        $this->assertDatabaseHas('products', $product);
    }
}
