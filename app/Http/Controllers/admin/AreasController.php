<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AreasController extends Controller
{
    public function showAreas(){
        $areas = [
            [
                'id' => 1,
                'area_name' => 'Area 1',
                'type' => 'EV',
                'fee' => 100,
                'fee_name' => 'Fee 1',
                'address' => '123 Main Street Anytown',
                'max_number'=> 20,
            ],
            [
                'id'=>2,
                'area_name' => 'Area 2',
                'type' => 'General',
                'fee' => 200,
                'fee_name' => 'Fee 2',
                'address' => '123 Main Street Anytown',
                'max_number'=> 10,
            ],
            [
                'id'=>3,
                'area_name' => 'Area 3',
                'type' => 'Disability',
                'fee' => 300,
                'fee_name' => 'Fee 3',
                'address' => '123 Main Street Anytown',
                'max_number'=> 10,
            ],
        ];

        return view('admin.areas.show', ['areas' => $areas]);
    }

    public function editRegisteredAreas(){
        return view('admin.areas.edit');
    }
    public function registerArea(){
        return view('admin.areas.show');
    }
}
