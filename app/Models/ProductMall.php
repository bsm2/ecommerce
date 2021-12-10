<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMall extends Model
{
    use HasFactory;
    protected $fillable = [
		'mall_id',
		'product_id',
	];

    public function mall()
    {
        return $this->hasOne(Mall::class,'id','mall_id');
    }
}
