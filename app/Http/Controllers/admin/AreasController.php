<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Area;

class AreasController extends Controller
{
    private $area;

    public function __construct(Area $area){
        $this->area = $area;
    }

    public function showAreas(Request $request){
        if($request->search) {
            $areas = $this->area->withTrashed()->where('name', 'like', '%' . $request->search . '%')->paginate(5);
        } else {
            $areas = $this->area->withTrashed()->orderBy('id')->paginate(5);
        }
        return view('admin.areas.show')
            ->with('areas', $areas)
            ->with('search', $request->search);
    }

    public function editRegisteredAreas(){
        return view('admin.areas.edit');
    }
    public function registerArea(){
        return view('admin.areas.show');
    }

    public function deactivateArea($id){
        $area = $this->area->find($id);
        $area->delete();
        return redirect()->route('admin.areas.show')
            ->with('success_delete', 'Area deactivated successfully');
    }

    public function activateArea($id){
        $area = $this->area->onlyTrashed()->findOrFail($id);
        $area->restore();
        return redirect()->route('admin.areas.show')
            ->with('success_restore', 'Area activated successfully');
    }

}
