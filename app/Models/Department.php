<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    public function faculty(){
        return $this->belongsTo(Faculty::class);
    }
    public function conplaint(){
        return $this->hasMany(Complain::class);
    }
}
