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
            ->assertJsonFragment([
                'data' => [
                    [
                        'type' =>  'products',
                        'id' => $product[0]->getRouteKey(),
                        'attributes' =>  [
                            'name' => $product[0]->name,
                            'description' => $product[0]->description,
                            'category' => $product[0]->category->name,
                            'price' => $product[0]->price,
                            'stock' => $product[0]->stock
                        ],
                        'links' => [
                            'self' => route('api.products.show', $product[0]->id)
                        ]
                    ],
                    [
                        'type' =>  'products',
                        'id' => $product[1]->getRouteKey(),
                        'attributes' =>  [
                            'name' => $product[1]->name,
                            'description' => $product[1]->description,
                            'category' => $product[1]->category->name,
                            'price' => $product[1]->price,
                            'stock' => $product[1]->stock
                        ],
                        'links' => [
                            'self' => route('api.products.show', $product[1]->id)
                        ]

                    ],
                    [
                        'type' =>  'products',
                        'id' => $product[2]->getRouteKey(),
                        'attributes' =>  [
                            'name' => $product[2]->name,
                            'description' => $product[2]->description,
                            'category' => $product[2]->category->name,
                            'price' => $product[2]->price,
                            'stock' => $product[2]->stock
                        ],
                        'links' => [
                            'self' => route('api.products.show', $product[2]->id)
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
        $this->withoutExceptionHandling();
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
        factory(Product::class)->create(['name' => 'C name']);
        factory(Product::class)->create(['name' => 'B name']);
        factory(Product::class)->create(['name' => 'A name']);

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
