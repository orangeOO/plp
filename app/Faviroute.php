<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Faviroute extends Model {

	public function goods() {
		return $this->belongsTo('App\Goods', 'goods_id');
	}

}
