<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Goods, App\Userinfo, App\Faviroute;

use Auth, Input, Redirect, Hash;

class UserController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * 展示个人资料页面
	 *
	 * @return Response
	 */
	public function anyIndex()
	{
		$user = Auth::user();
		return view('user/index')->withUser($user);
	}

	/**
	 * 展示浏览历史页面
	 *
	 * @return Response
	 */
	public function anyHistory() {
		$histories = Faviroute::whereRaw('user_id = ? and type = 0', [Auth::user()->id])->orderBy('updated_at', 'desc')->get();
		return view('user/history')->withHistories($histories);
	}

	/**
	 * 展示我的关注页面
	 *
	 * @return Response
	 */
	public function anyFollow() {
		$follows = Faviroute::whereRaw('user_id = ? and type = 1', [Auth::user()->id])->orderBy('updated_at', 'desc')->get();
		return view('user/follow')->withFollows($follows);
	}

	/**
	 * 展示我的发布页面
	 *
	 * @return Response
	 */
	public function anyGoods(Request $request) {
		$goodses = Goods::where('user_id', '=', Auth::user()->id)->get();
		return view('user/goods')->withGoodses($goodses);
	}

	/**
	 * 展示修改密码页面
	 *
	 * @return Response
	 */
	public function anyPassword() {
		return view('user/password');
	}

	/**
	 * 处理 上架 动作的逻辑
	 *
	 * @return Response
	 */
	public function anyPublish($id) {
		$goods = Goods::find($id);
		$goods->status = 1 - $goods->status;
		$goods->save();
		return Redirect::back();
	}

	/**
	 * 更新 个人资料 的实际逻辑
	 *
	 * @return Response
	 */
	public function anyUpdate($id) {
		$userinfo = Userinfo::find(Auth::user()->id);
		if($userinfo->update(Input::all())) {
			if(!empty(Input::file('headimg'))) {		//是否修改了头像
				$userinfo->headimg = $this->storeimage(Input::file('headimg'));
				$userinfo->save();
			}
			return Redirect::back();
		} else {
			return Redirect::back()->withInput()->withErrors();
		}
	}

	/**
	 * 处理 密码修改 的实际逻辑
	 *
	 * @return Response
	 */
	public function anyReset() {
		$user = Auth::user();
		if(Input::get('new_password') == Input::get('re_password')) {		//如果新密码和确认密码相同
			if (Auth::attempt(['email' => $user->email, 'password' => Input::get('old_password')])) {	//如果原始密码正确
				$user->password = Hash::make(Input::get('new_password'));
				$user->save();
				return Redirect::back();
			}
		}
	}

	/**
	 * 处理 关注、取消关注、删除浏览记录  的实际逻辑
	 *
	 * @return Response
	 */
	public function anyFaviroute($id, $action) {
		if($action == 'follow') {			//关注
			if(empty(Faviroute::find($id))) {
				$faviroute = new Faviroute;
				$faviroute->user_id = Auth::user()->id;
				$faviroute->goods_id = $id;
				$faviroute->type = 1;
				$faviroute->save();
			}
			return Redirect::back();

		} elseif ($action == 'unfollow') {	//取消关注
			$faviroute = Faviroute::whereRaw('user_id = ? and goods_id = ? and type = 1', [Auth::user()->id, $id])->first();
			if (!empty($faviroute)) {
				$faviroute->delete();
			}

			return Redirect::back();

		} elseif($action == 'delete') {		//删除历史记录
			$faviroute = Faviroute::whereRaw('user_id = ? and goods_id = ? and type = 0', [Auth::user()->id, $id])->first();
			$faviroute->delete();
			return Redirect::back(); 
		}
	}

	/**
	 * 保存前面上传过来的图片到Images目录并重命名
	 *
	 * @param $file Input::file类型
	 * @return 新的图片名字
	 */
	public function storeimage($file) {
		$filename = $file->getClientOriginalName();
		$extension = $file->getClientOriginalExtension() ?: 'png';
        $folderName = 'images/';
        $destinationPath = public_path() . '/' . $folderName;
        $safeName = str_random(10).'.'.$extension;
        $file->move($destinationPath, $safeName);		
        return $safeName;
	}


}
