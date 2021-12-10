<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $fillable = [
		'name_ar',
		'name_en',
		'category_id',
        'is_public'
	];

    public function category(){
        return $this->hasOne(Category::class,'id','category_id');
    }
}
