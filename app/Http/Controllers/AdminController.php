<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\User, App\Goods, App\Type;
use Input, Redirect, Auth;

class AdminController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function anyIndex() {
		$this->check();
		$users = User::all();
		return view('admin.user')->withUsers($users);
	}

	public function anyGoods() {
		$this->check();
		$goods = Goods::all();
		return view('admin.goods')->withGoodses($goods);
	}

	public function anyType() {
		$this->check();
		$types = Type::all();
		return view('admin.type')->withTypes($types);
	}

	public function anyPassword() {
		$this->check();
		return view('admin.password');
	}

	public function postAddtype() {
		$this->check();
		$type = new Type;
		$type->name = Input::get('name');
		$type->description = Input::get('description');
		$type->save();
		return Redirect::back();
	}

	public function anyDeltype() {
		$this->check();
		$type = Type::find(Input::get('id'));
		$type->delete();
		return Redirect::back();
	}

	public function anyEdittype() {
		$this->check();
		return view('admin.edit')->withType(Type::find(Input::get('id')));
	}

	public function anyDoedittype() {
		$this->check();
		$type = Type::find(Input::get('id'));
		$type->name = Input::get('name');
		$type->description = Input::get('description');
		$type->save();
		return Redirect::to('admin/type');
	}

	public function check() {
		if(!(Auth::check() && Auth::user()->email == 'admin@plp.com')) {
			echo '请以管理员身份登录';die;
		}
	}


}
