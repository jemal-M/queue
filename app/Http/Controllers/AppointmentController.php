<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Queue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index(){
        return Appointment::with(['service','user'])->get();
    }
    public function store(Request $request){
        $validated=$request->validate([
            'service_id'=>'required|exists:services,id',
            'appointment_date'=>'required|date',
            'appointment_time'=>'required'
        ]);
        $validated['user_id'] = Auth::id();
        $appointment = Appointment::create($validated);
        $queueCount = Queue::whereDate('created_at', now()->toDateString())->count() + 1;
        $queueNumber = 'Q-' . str_pad($queueCount, 3, '0', STR_PAD_LEFT);

        Queue::create([
            'appointment_id' => $appointment->id,
            'queue_number' => $queueNumber
        ]);

        return response()->json($appointment->load('service'),201);
    }
    public function show(Appointment $appointment){
        return $appointment->load(['service','user']);
    }
    
    public function update(Request $request,Appointment $appointment){
        $appointment->update($request->all());
        return $appointment;
    }
    public function destroy(Appointment $appointment){
        $appointment->delete();
        return response()->json(['message'=>'canceled']);
    }
}
