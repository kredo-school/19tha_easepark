<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeesController extends Controller
{
    public function updateRegisteredFees()
    {
        $fee_name = ['Normal Season'];

        return view('admin.fees.edit');
    }
}
