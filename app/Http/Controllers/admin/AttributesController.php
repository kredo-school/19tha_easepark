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


    public function editAttribute()
    {
        return view('admin.attributes.edit');
    }
}
