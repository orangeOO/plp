<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Userinfo extends Model {

	protected $fillable = array('headimg', 'phone_number', 'province', 'city', 'area', 'address_detail');

}
