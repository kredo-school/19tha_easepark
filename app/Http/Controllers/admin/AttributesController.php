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

    public function showAttribute()
    {
        $all_attributes = $this->attribute->latest()->get();
        return view('admin.attributes.show')->with('all_attributes', $all_attributes);
    }


    public function editAttribute($id)
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
        $attribute->name = ucwords(strtolower($request->name));
        $attribute->save();
        
        return redirect()->back();
    }
}
