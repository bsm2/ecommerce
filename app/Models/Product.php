<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
		'title',
		'content',
    'photo',
    'category_id',
    'trade_id',
    'manu_id',
    'color_id',
    'size',
    'size_id',
    'currency_id',
    'weight',
    'weight_id',
    'other_data',
    'status',
    'stock',
    'reason',
    'end_at',
    'start_at',
    'offer_end_at',
    'offer_start_at',
    'price',
    'offer_price'
	];

    public function files()
    {
      return $this->hasMany(File::class,'relation_id','id')->where('file_type','product');
    }

    public function other_data()
    {
      return $this->hasMany(OtherData::class,'product_id','id');
    }

    public function malls()
    {
      return $this->hasMany(ProductMall::class,'product_id','id');
    }
}
