<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];



    public function subCategory()
    {
        return $this->hasMany(subCategory::class, 'category_id');
    }
}
