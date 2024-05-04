<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Attribute;

class AttributeTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        Attribute::factory(10)->create();

        $attribute = Attribute::select()
            ->orderByDesc('id')
            ->first();
            print_r($attribute->toArray());
    }
}
