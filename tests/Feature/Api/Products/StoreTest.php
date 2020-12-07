<?php

namespace Tests\Feature\Api\Products;

use App\Category;
use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use refreshDatabase;

    /**
     * @test
     */
    public function aAuthenticatedCannotStoreAProduct()
    {
        $this->withoutExceptionHandling();
        $category = factory(Category::class)->create();

        $product = [
            'name' => 'name product',
            'category_id' => $category->id,
            'description' => 'this is the product description',
            'price' => 150000,
            'stock' => 12
        ];
        $response = $this->postJson(route('api.products.store'), $product)->dump();

        $response->assertSuccessful();

        $this->assertDatabaseHas('products', $product);
    }



    /**
     * @test
     */
    public function nameFieldIsRequired()
    {

        $category = factory(Category::class)->create();

        $product = [
            'name' => '',
            'category_id' => $category->id,
            'description' => 'Esta es la descripcion del producto',
            'price' => 150000,
            'stock' => 12
        ];
        $response = $this->postJson(route('api.products.store'), $product);
        $response->assertStatus(422);

    }

    /**
     * @test
     */
    public function descriptionFieldIsRequired()
    {
        $category = factory(User::class)->create();

        $product = [
            'name' => 'name product',
            'category_id' => $category->id,
            'description' => '',
            'price' => 150000,
            'stock' => 12
        ];
        $response = $this->postJson(route('api.products.store'), $product);
        $response->assertStatus(422);

    }

    /**
     * @test
     */
    public function CategoryFieldIsRequired()
    {
        $product = [
            'name' => 'name product',
            'category_id' => '',
            'description' => 'this is the product description',
            'price' => 150000,
            'stock' => 12
        ];
        $response = $this->postJson(route('api.products.store'), $product);
        $response->assertStatus(422);

    }

    /**
     * @test
     */
    public function priceFieldIsRequired()
    {
        $category = factory(User::class)->create();

        $product = [
            'name' => 'name product',
            'category_id' => $category->id,
            'description' => 'this is the product description',
            'price' => '',
            'stock' => 12
        ];
        $response = $this->postJson(route('api.products.store'), $product);
        $response->assertStatus(422);

    }

    /**
     * @test
     */
    public function stockFieldIsRequired()
    {
        $category = factory(User::class)->create();

        $product = [
            'name' => 'product name',
            'category_id' => $category->id,
            'description' => 'this is the product description',
            'price' => 150000,
            'stock' => ''
        ];
        $response = $this->postJson(route('api.products.store'), $product);
        $response->assertStatus(422);

    }
}
