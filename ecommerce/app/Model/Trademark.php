<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Trademark extends Model
{
	protected $table ='trademarks';
	protected $fillable=[
		'trademark_name_ar',
		'trademark_name_en',
		'logo',
	];
}
