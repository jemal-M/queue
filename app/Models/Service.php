<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'branch_id',
        'name',
        'description',
        'estimated_time',
        'is_active'
    ];
    public function branch(){
return $this->belongsTo(Branch::class);
    }
}
