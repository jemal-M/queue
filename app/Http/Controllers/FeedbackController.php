<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function store(Request $request){
        $vlidated=$request->validate([
            'appointment_id'=>'required|exists:appointments,id',
            'rating'=>'required|integer|min:1|max:5',
            'comment'=>'nullable|string'
        ]);

        return Feedback::create($vlidated);
    }
}
