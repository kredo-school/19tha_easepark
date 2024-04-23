<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeesController extends Controller
{
    public function showFees(){
        $fees = [
            [
                'id'=>1,
                'fee_name'=>'Normal Season',
                'amount_of_fee'=>20,
            ],
            [
                'id'=>2,
                'fee_name'=>'Peak Season',
                'amount_of_fee'=>30,
            ],
            [
                'id'=>3,
                'fee_name'=>'Promotion',
                'amount_of_fee'=>15,
            ],
        ];
        return view('admin.fees.show',['fees'=>$fees]);
    }

}
