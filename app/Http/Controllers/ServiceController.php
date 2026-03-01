<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Laravel\Mcp\Server;

class ServiceController extends Controller
{
    public function index(){
        return Service::with('branch')->get();
    }

   public function store(Request $request){
    $validated=$request->validate([
        'branch_id'=>'required|exists:branchs,id',
        'name'=>'required|string',
        'description'=>'nullable|string',
        'estimated_date'=>'required|integer'
    ]);

    return Service::created($validated);
   } 
   public function show(Service $service){
    return $service;
   }

   public function update(Request $request,Service $service){
    $service->update($request->all());
    return $service;
   }
   public function destroy(Service $service){
    $service->delete();
    return response()->json(['message'=>'deleted']);
   }
}
