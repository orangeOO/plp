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
			<li><a href="/user/goods">我的发布</a></li>
			<li><a href="/user/follow">我的关注</a></li>
			<li><a href="/user/history">浏览历史</a></li>
			<li  class="active"><a href="/user/password">修改密码</a></li>
		</ul>
	</div>

	<div class="col-xs-10">
		<div class="page-head white-block">
			<p>
				<span>修改密码<span>
			</p>
		</div>
	
		<div class="goods-wrapper white-block">
			<form method="post" action="/user/reset">
				<p><span class="left">原密码：</span><input name="old_password" type="password" placeholder="请输入原密码"></p>
				<p><span class="left">新密码：</span><input name="new_password" type="password" placeholder="请输入新密码"></p>
				<p><span class="left">确认新密码：</span><input name="re_password" type="password" placeholder="请再次输入密码"></p>
				<button class="submit" type="submit">提交</button>
			</form>
		</div>
	</div>
</div>

@endsection