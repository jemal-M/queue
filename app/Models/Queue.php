<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    protected $fillable = [
        'appointment_id',
        'queue_number',
        'status',
        'called_at',
        'served_at'
    ];
    public function appointments(){
        return $this->belongsTo(Appointment::class);
    }
}
