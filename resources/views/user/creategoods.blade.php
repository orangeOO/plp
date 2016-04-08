@extends('layouts.basic')

@section('contents')

<style>
	body{
		font-family: Arial, Verdana, 宋体;
		background-color: #f5f5f5;
	}
	body>.container{
		width: 1170px !important;
		max-width: none !important;
	}
	ul{
		list-style: none;
		margin: 0;
		line-height: 36px;
	}
	.nav a{
		color: inherit;
	}
	.page-head{
		font-size: 14px;
		margin-bottom: 20px;
	}
	.page-head p{
		padding: 10px 0 0;
		margin: 0;
	}
	.page-head .new{
		float: right;
		margin: 0;
	}
	.white-block{
		padding: 10px 20px 20px;
		background-color: #fff;
	}
	.goods-wrapper{
		padding: 30px 20px;
	}
	.active{
		color: rgb(228, 57, 60);
	}
	form>p{
		height: 40px;
	}

	.left{
		display: inline-block;
		width: 100px;
		text-align: right;
	}
	.title input{
		width: 500px;
	}
	.description{
		height: 300px;
	}
	.description .left{
		vertical-align: top;
	}
	.description textarea{
		width: 500px;
		height: 300px;
	}
	input[type=file]{
		width: 200px;
		display: inline-block;
	}
	.submit{
		margin-left: 100px;
	}
	.hint{
		color: #aaa;
		font-size: 12px;
	}


</style>

<div class="row">
	<div class="col-xs-2 nav">
		<ul>
			<li><a href="/user/index">个人资料</a></li>
			<li class="active"><a href="/user/goods">我的发布</a></li>
			<li><a href="/user/follow">我的关注</a></li>
			<li><a href="/user/history">浏览历史</a></li>
			<li><a href="/user/history">修改密码</a></li>
		</ul>
	</div>

	<div class="col-xs-10">
		<div class="page-head white-block">
			<p>
				<span>新建发布<span>
			</p>
		</div>
	
		<div class="goods-wrapper white-block">
			<form method="post" action="{{ url('/goods') }}" enctype="multipart/form-data">
				<p class="title"><span class="left">标题：</span><input name="title" type="text" placeholder="请输入物品标题，简明扼要地列出物品属性"></p>
				<p><span class="left">分类：</span>
					<select name="type">
						@foreach($types as $type)
							<option value="{{ $type->id }}">{{ $type->name }}</option>
						@endforeach
					</select>
				</p>
				<p class="description"><span class="left">描述：</span><textarea name="description" placeholder="请在这里描述将要出租的物品的详情信息。以及其它关于本次交易的要求。如果有额外要展示的信息，也请一并写在这里。"></textarea></p>
				<p><span class="left">价格：</span><input name="price" type="text" placeholder=""> 每天</p>
				<p><span class="left">租期：</span><input name="term" type="text" placeholder=""> 天</p>
				<p><span class="left">封面图：</span><input name="cover" type="file"><span class="hint">单张图片，作为物品展示的封面图，显示在首页</span></p>
				<p><span class="left">补充图片：</span><input name="images[]" multiple type="file"><span class="hint">可多选，将展示在物品详情页里面</span></p>
				<button class="submit" type="submit">发布</button>
			</form>
		</div>
	</div>
</div>

@endsection