<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $fillable = [
		'name_ar',
		'name_en',
		'country_id',
        'city_id'
	];

    public function country(){
        return $this->hasOne(Country::class,'id','country_id');
    }

    public function city(){
        return $this->hasOne(City::class,'id','city_id');
    }
}
