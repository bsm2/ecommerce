<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mall extends Model
{
    use HasFactory;

    protected $fillable = [
		'name_ar',
		'name_en',
        'facebook',
        'twitter',
        'website',
        'email',
        'phone',
        'contact',
        'country_id',
        'address',
        'lat',
        'lng',
        'logo',
	];

    public function country(){
        return $this->hasOne(Country::class,'id','country_id');
    }
}
