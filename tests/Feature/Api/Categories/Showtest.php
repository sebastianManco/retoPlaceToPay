<?php

namespace Tests\Feature\Api\Categories;

use App\Category;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Showtest extends TestCase
{
    use refreshDatabase;

    /**
     * @test
     */
    public function show_category()
    {
        $category = factory(Category::class)->create();

        $response = $this->getJson(route('api.categories.show',  $category->getRouteKey()));

        $response->assertJson([
            'data' => [
                'type' =>  'categories',
                'id' => $category->getRouteKey(),
                'attributes' =>  [
                    'name' => $category->name,
                ],
                'links' => [
                    'self' => route('api.categories.show', $category->getRouteKey())
                ]
            ],
        ]);
    }
}
