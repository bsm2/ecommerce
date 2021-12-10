<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
		'name_ar',
		'name_en',
        'icon',
        'description',
        'keyword',
		'parent_id',
	];

    public function parents(){
        return $this->hasMany(Category::class,'id','parent_id');
    }
}
