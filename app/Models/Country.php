<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;


class Country extends Model
{
    use HasFactory,Translatable;
    
    public $translatedAttributes = ['name'];

    protected $fillable = [
		'currency',
		'logo',
		'code',
		'mob',
	];

	public function cities(){
		return $this->hasMany(City::class);
	}

	public function malls(){
		return $this->hasMany(Mall::class,'country_id','id');
	}
}
