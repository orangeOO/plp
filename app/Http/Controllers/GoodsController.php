<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Goods;
use App\Type;
use App\Faviroute;

use Auth, Input, Redirect;

class GoodsController extends Controller {

	public function __construct() {
		$this->middleware('auth', ['except' => ['index', 'show','search']]);	//必须登录
	}

	/**
	 * 展示网站首页
	 *
	 * @param $typeid 分类id
	 * @return Response
	 */
	public function index($typeid=null)
	{
		if(Auth::check() && Auth::user()->email == 'admin@plp.com') {
			return Redirect::to('admin');
		}
		//有分类id时，只显示此分类的物品。status=0代表物品已上架
		if(empty($typeid)) {
			$type = Type::find(1);
			$goodses = Goods::where('status', '=', 0)->get();
		} else {
			$type = Type::find($typeid);
			$goodses = Goods::whereRaw('type = ? and status = 0', [$typeid])->get();
		}
		
		$types = Type::all();
		return view('home')->withGoodses($goodses)->withCurrentType($type)->withTypes($types);
	}

	/**
	 * 展示创建新发布的页面
	 *
	 * @return Response
	 */
	public function create()
	{
		$types = Type::all();
		return view('user/creategoods')->withTypes($types);
	}

	/**
	 * 新发布物品的实际处理逻辑
	 *
	 * @return Response
	 */
	public function store()
	{
		$goods = new Goods;

		$goods->user_id = Auth::user()->id;
		$goods->title = Input::get('title');
		$goods->description = Input::get('description');
		$goods->price = Input::get('price');
		$goods->term = Input::get('term');
		$goods->type = Input::get('type');
		$goods->status = 0;

		$goods->cover = $this->storeimage(Input::file('cover'));
		$images_arr = array();
		foreach(Input::file('images') as $image) {
			$images_arr[] = $this->storeimage($image);
		}
		$goods->images = json_encode($images_arr);

		if($goods->save()) {
			return Redirect::to('user/goods');
		} else {
			return Redirect::back()->withInput()->withErrors('更新失败！');
		}
	}

	/**
	 * 保存前端上传的图片并重命名
	 * 
	 * @param $file Input::file()类型
	 * @return 命名过后的新图片名字
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

	/**
	 * 展示物品详情页
	 *
	 * @param  int  $id 物品id
	 * @return Response
	 */
	public function show($id)
	{
		$goods = Goods::find($id);
		if(empty($goods)) {
			return '你访问的物品不存在或已被删除，点击<a href="/">回到首页</a>';
		}

		//如果已登录
		if(Auth::check()) {
			//访问量加1
			$goods->hits = $goods->hits + 1;
			$goods->save();		

			//为当前用户添加浏览历史记录
			$history = Faviroute::whereRaw('user_id = ? and goods_id = ? and type = 0', [Auth::user()->id, $id])->first();
			if(!empty($history)) {		//如果已存在此浏览记录，更新浏览时间
				$history->update();		
			} else {					//否则新建条记录
				$history = new Faviroute;
				$history->user_id = Auth::user()->id;
				$history->goods_id = $id;
				$history->save();
			}	
		}

		return view('goods')->withGoods($goods);
	}

	/**
	 * 展示已发布物品的编辑页面
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$types = Type::all();
		$goods = Goods::find($id);
		return view('user/editgoods')->withGoods($goods)->withTypes($types);
	}

	/**
	 * 物品更新的实际处理逻辑，物品编辑页面提交后会到这里来实际更新物品信息
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$goods = Goods::find($id);

		$goods->title = Input::get('title');
		$goods->description = Input::get('description');
		$goods->price = Input::get('price');
		$goods->term = Input::get('term');
		$goods->type = Input::get('type');

		//封面图
		if(Input::hasFile('cover')) {
			$goods->cover = $this->storeimage(Input::file('cover'));
		}

		//其它补充图片
		if(Input::hasFile('images')) {
			$images_arr = array();
			foreach(Input::file('images') as $image) {
				$images_arr[] = $this->storeimage($image);
			}
			$goods->images = json_encode($images_arr);		
		}

		if($goods->save()) {
			return Redirect::to('user/goods');
		} else {
			return Redirect::back()->withInput()->withErrors('更新失败！');
		}
	}

	/**
	 * 删除已发布物品信息的实际处理逻辑
	 *
	 * @param  int  $id 物品id
	 * @return Response
	 */
	public function destroy($id)
	{
		$goods = Goods::find($id);
		$goods->delete();
		return Redirect::back()->withInfo('成功删除了一个物品');
	}

	public function search() {
		$keyword = Input::get('key', '');
		$searchword = '%' . $keyword . '%';
		$results = Goods::whereRaw('title like ? or description like ?', [$searchword, $searchword])->get();
		return view('search')->withGoodses($results)->withKeyword($keyword);
	}

}
