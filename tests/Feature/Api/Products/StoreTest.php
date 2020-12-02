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
            ;

        $this->assertDatabaseHas('products', $product);


    }

    /**
     * @test
     */
    public function nameFielIsRequired()
    {
        factory(User::class)->create();
        $product = factory(Category::class)->create(['name' => '']);

        $response = $this->postJson(route('api.products.store', [
            'data' => [
                'type' => 'products',
                'attributes' => $product
            ]
        ]));

        $response->dump();

    }
}
