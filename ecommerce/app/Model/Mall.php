<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Mall extends Model
{
    protected $table ='malls';
	protected $fillable=[
		'mall_name_ar',
		'mall_name_en',
		'facebook',
		'twitter',
		'address',
		'website',
		'email',
		'mobile',
		'country_id',
		'contact_name',
		'lng',
		'lat',
		'logo',
	];
	public function country_id(){
		return $this->hasOne('App\Model\Country','id','country_id');
	}
}
