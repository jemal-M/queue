<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use Illuminate\Http\Request;

class QueueController extends Controller
{
public function index(){
    return Queue::with('appointment')->get();
}
public function callNext($id){
    $queue=Queue::findOrFail($id);
    $queue->update([
        'status'=>'serving',
        'called_at'=>now()
    ]);
     return $queue;
}
public function completed($id){
    $queue=Queue::findOrFail($id);
    $queue->update([
        'status'=>'completed',
        'served_at'=>now()
    ]);
    return $queue;
}
}
