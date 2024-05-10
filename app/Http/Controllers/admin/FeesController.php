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

    public function showFees()
    {
        $fees = $this->fee->all();
        return view('admin.fees.show')
            ->with('fees', $fees);
    }

    public function updateRegisteredFees()
    {
        $fee_name = ['Normal Season'];
        return view('admin.fees.edit');
    }

    public function searchFees(Request $request)
    {
        $search = $request->input('search', '');
        $fees = $this->fee->where('name', 'like', '%' . $search . '%')->paginate(5);
        return view('admin.fees.show')
            ->with('fees', $fees)
            ->with('search', $search);
    }
}
