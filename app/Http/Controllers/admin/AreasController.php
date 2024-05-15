<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Attribute;
use App\Models\Fee;

class AreasController extends Controller
{
    private $area;

    public function __construct(Area $area)
    {
        $this->area = $area;
    }

    public function showAreas(Request $request)
    {
        if ($request->search) {
            $areas = $this->area->withTrashed()->where('name', 'like', '%' . $request->search . '%')->paginate(5);
        } else {
            $areas = $this->area->withTrashed()->orderBy('id')->paginate(5);
        }

        $all_attributes = Attribute::all();
        $all_fees = Fee::all();

        return view('admin.areas.show')
            ->with('areas', $areas)
            ->with('search', $request->search)
            ->with('all_attributes', $all_attributes)
            ->with('all_fees', $all_fees);
    }

    public function editRegisteredAreas()
    {
        return view('admin.areas.edit');
    }

    public function registerArea(Request $request)
    {
        $request->validate([
            'name'        => 'required|max:50',
            'attribute_id' => 'required|exists:attributes,id',
            'fee_id'      => 'required|exists:fees,id',
            'address'     => 'required|max:255',
            'max_num'  => 'required|integer'
        ]);

        $this->area->name = $request->name;
        $this->area->attribute_id = $request->attribute_id;
        $this->area->fee_id = $request->fee_id;
        $this->area->address = $request->address;
        $this->area->max_num = $request->max_num;
        $this->area->save();

        return redirect()->route('admin.areas.show')
            ->with('success_register', 'New area registered successfully.');
    }
}
