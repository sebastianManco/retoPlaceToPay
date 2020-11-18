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

        $response = $this->getJson(route('api.products.show', $product->id));

        $response->assertHeader('content-type', 'application/json')
            ->assertJsonFragment([
                'id' => $product->id,
                'name' => $product->name,
            ]);

    }
}
