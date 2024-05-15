<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute;

class AttributesController extends Controller
{
    private $attribute;

    public function __construct(Attribute $attribute)
    {
        $this->attribute = $attribute;
    }

    public function showAttribute(Request $request)
    {
        $search = $request->input('search_attributes');

        if($search) {
            $all_attributes = $this->attribute
            ->withTrashed()
            ->where('name', 'like', '%'. $search. '%')
            ->orderBy('id', 'asc')
            ->paginate(5);
        } else {
            $all_attributes = $this->attribute
            ->withTrashed()
            ->orderBy('id', 'asc')
            ->paginate(5);
        }

        return view('admin.attributes.show')
            ->with('attributes', $all_attributes)
            ->with('search', $search);

    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:1|max:50|unique:attributes,name'
        ]);

        $this->attribute->name = $request->name;
        $this->attribute->save();

        return redirect()->back()->with('success_register', 'The attribute registered successfully.');
    }


    public function showEditAttributePage($id)
    {
        $attribute = $this->attribute->findOrFail($id);
        return view('admin.attributes.edit')->with('attribute', $attribute);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|min:1|max:50|unique:attributes,name,' . $id
        ]);

        $attribute       = $this->attribute->findOrFail($id);
        $attribute->name = $request->name;
        $attribute->save();

        return redirect()->route('admin.attributes.show')->with('success_update', 'The selected attribute updated successfully.');
    }

    public function deactivateAttributes($id)
    {
        $attribute = $this->attribute->findOrFail($id);
        $attribute->delete();

        return redirect()->back()->with('success_delete', 'The selected attribute has been deactivated.');
    }

    public function activateAttributes($id)
    {
        $attribute = $this->attribute->onlyTrashed()->findOrFail($id);
        $attribute->restore();

        return redirect()->back()->with('success_restore', 'The selected attribute has been activated.');
    }

}
