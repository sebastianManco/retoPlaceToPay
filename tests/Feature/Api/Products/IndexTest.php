<?php

namespace Tests\Feature\Api\Products;

use App\Category;
use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use refreshDatabase;
    /**
     * @test
     */
    public function returnJsonResponseFormProductsIndex()
    {
        factory(Category::class)->create();
        factory(Product::class, 2)->create();

        $response = $this->getJson(route('api.products.index'));

        $response->assertSuccessful();
        $response->assertHeader('content-type', 'application/json');
        $response->assertJsonCount(2, 'data');
    }
}
