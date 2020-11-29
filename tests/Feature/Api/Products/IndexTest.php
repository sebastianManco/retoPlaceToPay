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
        $this->withoutExceptionHandling();

        factory(Category::class)->create();
        $product = factory(Product::class)->times(3)->create();

        $response = $this->getJson(route('api.products.index'));

        $response->assertSuccessful()
            ->assertExactJson([
                'data' => [
                    [
                        'type' =>  'product',
                        'id' => $product[0]->getRouteKey(),
                        'attributes' =>  [
                            'name' => $product[0]->name,
                            'description' => $product[0]->description,
                            'category' => $product[0]->category->name,
                            'price' => $product[0]->price,
                            'stock' => $product[0]->stock
                        ]
                    ],
                    [
                        'type' =>  'product',
                        'id' => $product[1]->getRouteKey(),
                        'attributes' =>  [
                            'name' => $product[1]->name,
                            'description' => $product[1]->description,
                            'category' => $product[1]->category->name,
                            'price' => $product[1]->price,
                            'stock' => $product[1]->stock
                        ]

                    ],
                    [
                        'type' =>  'product',
                        'id' => $product[2]->getRouteKey(),
                        'attributes' =>  [
                            'name' => $product[2]->name,
                            'description' => $product[2]->description,
                            'category' => $product[2]->category->name,
                            'price' => $product[2]->price,
                            'stock' => $product[2]->stock
                        ]

                    ],
                ]
            ]);

    }

    /**
     * @test
     */
    public function itCanSortProductsByNameAsc()
    {
        factory(Category::class)->create();
        factory(Product::class)->create(['name' => 'A name']);
        factory(Product::class)->create(['name' => 'B name']);
        factory(Product::class)->create(['name' => 'C name']);

        $response = $this->getJson(route('api.products.index',  ['sort' => 'name']));

        $response->assertSeeInOrder([
            'A name',
            'B name',
            'C name',
        ]);
    }

    /** @test */
    public function itCansortArticlesByTitleDesc()
    {
        factory(Category::class)->create();
        $product1 = factory(Product::class)->create(['name' => 'C name']);
        $product2 = factory(Product::class)->create(['name' => 'B name']);
        $product3 = factory(Product::class)->create(['name' => 'A name']);

        $response = $this->getJson(route('api.products.index',  ['sort' => 'name']));

        $response->assertSeeInOrder([
            'C name',
            'B name',
            'A name',
        ]);
    }

    /**
     * A basic feature test example.
     *
     * @test
     */
    public function catFetchPaginatedProducts()
    {
        $this->withoutExceptionHandling();

        factory(Category::class)->create();
        $products = factory(Product::class)->times(10)->create();

        $url = route('api.products.index', ['page[size]' => 2, 'page[number]' => 3]);

        $response = $this->getJson($url);

        $response->assertJsonCount(2, 'data')
            ->assertDontSee($products[0]->name)
            ->assertDontSee($products[1]->name)
            ->assertDontSee($products[2]->name)
            ->assertDontSee($products[3]->name)
            ->assertSee($products[4]->name)
            ->asserSee($products[5]->name)
            ->assertDontSee($products[6]->name)
            ->assertDontSee($products[7]->name)
            ->assertDontSee($products[8]->name)
            ->assertDontSee($products[9]->name);

        $response->assertJsonStructure([
            'links' => ['first', 'last', 'prev', 'next']
        ]);

        $response->assertJsonFragment([
            'first' => route('api.products.index', ['page[size]' => 2, 'page[number]' => 1]),
            'last' => route('api.products.index', ['page[size]' => 2, 'page[number]' => 5]),
            'prev' => route('api.products.index', ['page[size]' => 2, 'page[number]' => 2]),
            'next' => route('api.products.index', ['page[size]' => 2, 'page[number]' => 4])
        ]);


    }
}
