<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Faker\Factory;

class FeesController extends Controller
{
    
    public function showFees(){
        $faker = Factory::create();

        $fees = [];
        for ($i = 0; $i < 5; $i++) {
            $fees[] = [
                'id' => $i + 1,
                'fee_name' => $faker->word,
                'amount_of_fee' => $faker->randomNumber(2),
            ];
        }

        return view('admin.fees.show', ['fees' => $fees]);
    }
    public function updateRegisteredFees()
    {
        $fee_name = ['Normal Season'];

        return view('admin.fees.edit');
    }
}
