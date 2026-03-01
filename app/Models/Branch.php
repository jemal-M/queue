<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'organization',
        'name',
        'location',
        'is_active'
    ];

    public function organization(){
        return $this->belongsTo(Organization::class);
    }
    public function services(){
        return $this->hasMany(Service::class);
    }
}
