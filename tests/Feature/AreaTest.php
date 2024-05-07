<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Area;

class AreaTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        Area::factory(10)->create();

        $area = Area::select()
            ->orderByDesc('id')
            ->first();
            print_r($area->toArray());
    }
}
