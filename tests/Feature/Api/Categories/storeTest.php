<?php

namespace Tests\Feature\Api\Categories;

use App\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class storeTest extends TestCase
{
    use refreshDatabase;
    /**
     * @test
     */
    public function aAuthenticatedCannotStoreAProduct()
    {
        $category = [
            'name' => 'computer',
            ];
        $response = $this->postJson(route('api.categories.store'), $category);

        $response->assertSuccessful();

        $this->assertDatabaseHas('categories', $category);
    }

    /**
     * @test
     */
    public function theCategoryNameFieldIsRequired()
    {

        $category = [
            'name' => '',
        ];
        $response = $this->postJson(route('api.categories.store'), $category);
        $response->assertStatus(422);

    }

    /**
     * @test
     */
    public function theNameOfCategoryCannotBeMoreThanFortyCharacters()
    {
        $category = factory(Category::class)->raw(['name', Str::random(40)]);

        $response = $this->postJson(route('api.categories.store'), $category);
        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function theNameOfCategoryCannotLessThanThreeCharacters()
    {
        $category = factory(Category::class)->raw(['name', Str::random(2)]);

        $response = $this->postJson(route('api.categories.store'), $category);
        $response->assertStatus(422);
    }


    /**
     * @test
     */
    public function theNameOfCategoryCannotContainNumbers()
    {
        $category = factory(Category::class)->raw(['name', 'C0mput3r']);

        $response = $this->postJson(route('api.categories.store'), $category);
        $response->assertStatus(422);
    }


}
