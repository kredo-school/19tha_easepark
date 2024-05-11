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

    public function showFees(Request $request)
    {
        if($request->search) {
            $fees = $this->fee->where('name', 'like', '%' . $request->search . '%')->paginate(5);
        } else {
            $fees = $this->fee->orderBy('id')->paginate(5);
        }
        return view('admin.fees.show')
            ->with('fees', $fees)
            ->with('search', $request->search);
    }

    public function updateRegisteredFees()
    {
        $fee_name = ['Normal Season'];
        return view('admin.fees.edit');
    }

}
