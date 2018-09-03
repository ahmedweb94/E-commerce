<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Manufact extends Model
{
	protected $table ='manufacts';
	protected $fillable=[
		'manufact_name_ar',
		'manufact_name_en',
		'facebook',
		'twitter',
		'address',
		'website',
		'email',
		'mobile',
		'contact_name',
		'lng',
		'lat',
		'logo',
	];
}
