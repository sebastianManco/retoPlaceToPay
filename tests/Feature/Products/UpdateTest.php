<?php

namespace Tests\Feature\Products;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function aNotAuthenticatedCannotUpdateAProduct()
    {
        $response = $this->get(route('products.index'));

        $response->assertRedirect(route('login'));
    }
}
