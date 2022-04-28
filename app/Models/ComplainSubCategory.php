<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplainSubCategory extends Model
{
    use HasFactory;
    public function complainCategory(){
        return $this->belongsTo(ComplainCategory::class);
    }
    public function complaint(){
        return $this->hasMany(Complain::class);
    }
}
