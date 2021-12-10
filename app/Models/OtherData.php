<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherData extends Model
{
    use HasFactory;

    protected $fillable = [
		'input_key',
		'input_value',
		'product_id',
	];


}
