<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        User::factory(10)->create();

        $user = User::select()
            ->orderByDesc('id')
            ->first();
            print_r($user->toArray());
    }
}
