<?php

namespace Tests\Feature\Api\Products;

use App\Category;
use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use refreshDatabase;

    /**
     * @test
     */
    public function update_product()
    {
        $this->withoutExceptionHandling();
        factory(Category::class)->create();
        $product = factory(Product::class)->create();

        $response = $this->putJson(route('api.products.update', $product->id), [
            'name' => 'celular inteligente',
            'description' => 'bueno, bonito y barato',
            'category_id' => 1,
            'price' => 20000,
            'stock' => 15
        ]);

        $product = $product->refresh();
        $this->assertEquals('celular inteligente', $product->name);
        $this->assertEquals('bueno, bonito y barato', $product->description);
        $this->assertEquals('1', $product->category_id);
        $this->assertEquals('20000', $product->price);
        $this->assertEquals('15', $product->stock);

        $response->assertHeader('content-type', 'application/json');
    }
}
