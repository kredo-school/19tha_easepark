<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Admin;

class AdminTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    Admin::factory(10)->create();

    $admin = Admin::select()
        ->orderByDesc('id')
        ->first();
        print_r($admin->toArray());
}
