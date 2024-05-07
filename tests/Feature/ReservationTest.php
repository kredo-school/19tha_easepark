<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Reservation;

class ReservationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        Reservation::factory(10)->create();

        $reservation = Reservation::select()
            ->orderByDesc('id')
            ->first();
            print_r($reservation->toArray());
    }
}
