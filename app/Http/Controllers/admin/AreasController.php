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
}
