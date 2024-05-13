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
        return view('admin.fees.show', ['fees' => $fees]);
    }

    public function updateRegisteredFees()
    {
        $fee_name = ['Normal Season'];

        return view('admin.fees.edit');
    }

    public function registerFee(Request $request)
    {
        $request->validate([
            'name' => 'required|min:1|max:50',
            'fee' => 'required|numeric|min:0.01|max:99999.99'
        ]);

        $this->fee->name =  $request->name;
        $this->fee->fee = $request->fee;
        $this->fee->save();

        return redirect()->route('admin.fees.show')
            ->with('success_register', ' The added fee registered successfully.');
    }
}
