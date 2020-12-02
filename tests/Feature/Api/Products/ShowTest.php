<?php

namespace Tests\Feature;

use App\Category;
use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use refreshDatabase;

    /**
     * @test
     */
    public function show_product()
    {
        factory(Category::class)->create();
        $product = factory(Product::class)->create();

        $response = $this->getJson(route('api.products.show', $product->getRouteKey()));

        $response->assertJson([
            'data' => [
                'type' =>  'product',
                'id' => $product->getRouteKey(),
                'attributes' =>  [
                    'name' => $product->name,
                    'description' => $product->description,
                    'category' => $product->category->name,
                    'price' => $product->price,
                    'stock' => $product->stock
                    ],
                    'links' => [
                        'self' => route('api.products.show', $product->getRouteKey())
                    ]
                ],
            ]);
    }
}
