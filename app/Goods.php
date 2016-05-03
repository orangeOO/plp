<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

//物品表
class Goods extends Model {


	//关联user表
	public function user() {
		return $this->belongsTo('App\User', 'user_id');
	}

	//返回有多少人关注的数量
	public function fans() {
		return Faviroute::whereRaw('goods_id = ? and type = 1', [$this->id])->count();
	}

	//关联type表
	public function typeinfo() {
		return $this->belongsTo('App\Type', 'type');
	}

	//判断当前用户是否关注了本物品
	public function isFocused() {
		if(Auth::check()) {
			$result = Faviroute::whereRaw('user_id = ? and goods_id = ? and type = 1 ', [Auth::user()->id, $this->id])->first();
			return empty($result);			
		}
		return true;
	}


}
