<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\warehouses;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class WarehouseController extends Controller
{
    public function index()
    {
        $warehouses = warehouses::all();
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('warehouses.index',compact('warehouses','statuses'));
    }

    
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required'
        ]);
        
        $user = Auth::user();
        $user_id = $user->id;

        $warehouses = new warehouses();
        $warehouses->name = $request['name'];
        $warehouses->slug = Str::slug($request['name']);
        $warehouses->status_id = $request['status_id'];
        $warehouses->user_id = $user_id;

        $warehouses->save();

        session()->flash("success", "New Warehouse Created");
        return redirect(route('warehouses.index'));
    }


    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {

        $user = Auth::user();
        $user_id = $user->id;

        $warehouses = warehouses::findOrFail($id);
        $warehouses->name = $request['name'];
        $warehouses->slug = Str::slug($request['name']);
        $warehouses->status_id = $request['status_id'];
        $warehouses->user_id = $user_id;

        $warehouses->save();

        session()->flash("success", "Update Successfully");
        return redirect(route('warehouses.index'));

    }

    public function destroy(string $id)
    {
        $warehouses = warehouses::findOrFail($id);
        $warehouses->delete();

        session()->flash("danger", "Delete Successfully"); 
        return redirect()->back();
    }
}
