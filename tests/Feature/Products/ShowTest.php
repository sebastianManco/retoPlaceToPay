<?php

namespace Tests\Feature\Products;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function aNotAuthenticatedUserCannotShowViewAProduct()
    {
        $response = $this->get(route('categories.index'));

        $response->assertRedirect(route('login'));
    }
}
