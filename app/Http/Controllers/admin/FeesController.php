<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Fee;

class FeesController extends Controller
{
    private $fee;

    public function __construct(Fee $fee)
    {
        $this->fee = $fee;
    }

    public function showFees(){
        $fees = $this->fee->all();
        return view('admin.fees.show',['fees'=>$fees]);
    }

    public function updateRegisteredFees()
    {
        $fee_name = ['Normal Season'];

        return view('admin.fees.edit');
    }
}
