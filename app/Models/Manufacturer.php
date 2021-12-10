<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
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
        'address',
        'lat',
        'lng',
        'logo',
	];
}
