<?php

namespace Tests\Feature\Categories;

use App\Category;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function aNotAuthenticatedUserCannotSeeTheIndexOfCategories()
    {
        $response = $this->get(route('categories.index'));

        $response->assertRedirect(route('login'));
    }


    /**
     * @test
     */
    public function aAuthenticatedUserCanSeeTheIndexOfCategories()
    {
        $user = factory(User::class)->create();
        $category = factory(Category::class)->create([
            'name' => 'phones'
    ]);

        $response = $this->actingAs($user)
            ->get(route('categories.index'));

        $response->assertStatus(200);
        $response->assertViewIs('categories.index');
        $response->assertViewHas('category');

        $responseCategories = $response->getOriginalContent()['category'];
        $responseCategories->each(function ($item) use ($category) {
            $this->assertEquals($category->id, $item->id);
        });
    }
}
