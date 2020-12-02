<?php

namespace Tests\Feature\Api\Categories;

use App\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class indexTest extends TestCase
{
    use refreshDatabase;

    /**
     * @test
     */
    public function returnJsonResponseFormCategoriesIndex()
    {
        $this->withoutExceptionHandling();

        $category  = factory(Category::class)->times(3)->create();

        $response = $this->getJson(route('api.categories.index'));

        $response->assertSuccessful()
            ->assertJsonFragment([
                'data' => [
                    [
                        'type' =>  'categories',
                        'id' => $category[0]->getRouteKey(),
                        'attributes' =>  [
                            'name' =>  $category[0]->name,
                        ],
                        'links' => [
                            'self' => route('api.categories.show',  $category[0]->id)
                        ]
                    ],
                    [
                        'type' =>  'categories',
                        'id' =>  $category[1]->getRouteKey(),
                        'attributes' =>  [
                            'name' =>  $category[1]->name,
                        ],
                        'links' => [
                            'self' => route('api.categories.show', $category[1]->id)
                        ]
                    ],
                    [
                        'type' =>  'categories',
                        'id' =>  $category[2]->getRouteKey(),
                        'attributes' =>  [
                            'name' =>  $category[2]->name,
                        ],
                        'links' => [
                            'self' => route('api.categories.show',  $category[2]->id)
                        ]
                    ],
                ]
            ]);
    }
}
