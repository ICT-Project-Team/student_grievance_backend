<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complainer extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_name',
        'student_id',
        'gender',
        'student_type',
        'student_year',
        'address',
        'phone_no',
        'email'
    ];

    public function complains()
    {
        return $this->hasOne(Complain::class);
    }
}
