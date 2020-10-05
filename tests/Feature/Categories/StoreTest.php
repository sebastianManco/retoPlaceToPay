<?php

namespace Tests\Feature\Categories;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function aNotAuthenticatedUserCannotStoreACategory()
    {
        $response = $this->get(route('categories.store'));

        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function aAuthenticatedUserCanStoreACategory()
    {
       $user = factory(User::class)->create();
       $this->actingAs($user)
           ->post(route('categories.store'), [
               'name' => 'phones'
           ]);

       $this->assertDatabaseHas('categories', [
           'name' => 'phones'
       ]);
    }

    /**
     * @test
     */
    public function categoryNameIsRequired()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)
            ->from(route('users.create'))
            ->post(route('categories.store'), [
                'name' => ''
            ]);

        $response->assertSessionHasErrors('name');
        $response->assertRedirect(route('users.create'));
    }

    /**
     * @test
     */
    public function categoryNameMustBeGreaterThanThreeCharacters()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)
            ->from(route('users.create'))
            ->post(route('categories.store'), [
                'name' => 'sd'
            ]);

        $response->assertSessionHasErrors('name');
        $response->assertRedirect(route('users.create'));
    }

    /**
     * @test
     */
    public function categoryNameMustBeLessThanFortyCharacters()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)
            ->from(route('users.create'))
            ->post(route('categories.store'), [
                'name' => Str::random(41)
            ]);

        $response->assertSessionHasErrors('name');
        $response->assertRedirect(route('users.create'));
    }

    /**
     * @test
     */
    public function categoryNameMustContainOnly()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)
            ->from(route('users.create'))
            ->post(route('categories.store'), [
                'name' => 'c3lu14r35'
            ]);

        $response->assertSessionHasErrors('name');
        $response->assertRedirect(route('users.create'));
    }


}
