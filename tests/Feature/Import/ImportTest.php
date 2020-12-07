<?php

namespace Tests\Feature\Import;

use App\Exports\ProductExport;
use App\Imports\ProductImport;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class ImportTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function userCanQueueTheProductImport()
    {
        $this->withoutExceptionHandling();
        Excel::fake();

        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->post(route('productImport'));

        Excel::assertQueued('product.xlsx');

        Excel::assertQueued('product.xlsx', function(ProductImport $import) {
            return true;
        });
    }
}
