<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
public function index(){
    return response()->json(Organization::with('branchs')->get());
}
public function store(Request $request){
  $validated=$request->validate([
    'name'=>'required|string|max:255',
    'email'=>'nullable|email',
    'phone'=>'nullable|string',
    'address'=>'nullable|string'
  ]);
  $organization=Organization::created($validated);
  return response()->json($organization,201);
}
public function show(Organization $organization){
    return response()->json($organization->load('branchs'));
}
public function update(Request $request,Organization $organization){
    $validated=$request->validate([
        'name'=>'sometimes|required|string|max:255',
        'email'=>'nullable|email',
        'phone'=>'nullable|string',
        'address'=>'nullable|string',
        'is_active'=>'boolean'
    ]);
    $organization->update($validated);
    return response()->json($organization);
}
public function destroy(Organization $organization){
    $organization->delete();
    return response()->json(['message'=>'Deleted successfuly deleted']);
}
}
