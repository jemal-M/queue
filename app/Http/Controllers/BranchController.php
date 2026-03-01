<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index(){
        return Branch::with('organizations')->get();
    }
    public function store(Request $request){
        $validated=$request->validate(
            [
                'organization_id'=>'required|exists:organizations,id',
                'name'=>'required|string',
                'location'=>'required|string'
            ]
        );
        return Branch::created($validated);
    }
    public function show(Branch $branch){
     return $branch->load('services');
    }
    public function update(Request $request,Branch $branch){
        $branch->update($request->all());
        return $branch;
    }

    public function destroy(Branch $branch){
        $branch->delete();
        return response()->json([
            'message'=>'deleted'
        ]);
    }
}
