<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
        protected $filliable=[
        'name',
        'email',
        'phone',
        'address',
        'is_active'
    ];

    public function branchs(){
        return $this->hasMany(Branch::class);
    }
}
