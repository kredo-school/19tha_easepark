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

    public function registerFee(Request $request)
    {
        $request->validate([
            'name' => 'required|min:1|max:50',
            'fee' => 'required|numeric|between:0.01,99999.99'
        ]);

        $this->fee->name =  $request->name;
        $this->fee->fee = $request->fee;
        $this->fee->save();

        return redirect()->route('admin.fees.show')
            ->with('success_register', ' The added fee registered successfully.');
    }
    
    public function showEditFeePage($id)
    {
        $fee = $this->fee->findOrFail($id);
        return view('admin.fees.edit', ['fee' => $fee]);
    }

    public function updateRegisteredFees(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:1|max:50',
            'fee' => 'required|numeric|between:0.01,99999.99'
        ]);

        $fee = $this->fee->findOrFail($id);
        $fee->name = $request->name;
        $fee->fee = $request->fee;
        $fee->save();

        return redirect()->route('admin.fees.show')->with('success_update', 'The selected fee updated successfully.');
    }

    public function  destroyFees($id)
    {
        $fee = $this->fee->findOrFail($id);
        $fee->forceDelete();
        return redirect()->route('admin.fees.show')->with('success_delete', 'The selected fee has been deleted.');
    }

}
