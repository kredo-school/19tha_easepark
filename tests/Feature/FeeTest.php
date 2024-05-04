<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Fee;

class FeeTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        Fee::factory(10)->create();

        $fee = Fee::select()
            ->orderByDesc('id')
            ->first();
            print_r($fee->toArray());
    }
}
