<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    use HasFactory;
    protected $fillable  = [
        'complain_sub_category_id',
        'department_id',
        'complainer_id',
        'progress',
        'objective',
        'reference',
        'statement',
    ];

    public function complain_sub_category()
    {
        return $this->belongsTo(ComplainSubCategory::class);
    }
    public function department(){
        return $this->belongsTo(Department::class);
    }
    public function complainer(){
        return $this->belongsTo(Complainer::class);
    }
}
