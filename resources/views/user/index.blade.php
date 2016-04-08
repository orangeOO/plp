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
	.white-block{
		padding: 10px 20px 20px;
		background-color: #fff;
	}
	.info-wrapper{
		padding: 30px 20px;
	}
	.active{
		color: rgb(228, 57, 60);
	}
	.info>p{
		height: 30px;
	}
	.info>p>span{
		display: inline-block;
		width: 100px;
		text-align: right;
	}
	.info>button{
		margin-left: 100px;
	}
	.headimg{
		float: right;
	}
	.headimg img{
		width: 100px;
		height: 100px;
		margin: 10px auto;
	}

</style>

<div class="row">
	<div class="col-xs-2 nav">
		<ul>
			<li class="active"><a href="/user/index">个人资料</a></li>
			<li><a href="/user/goods">我的发布</a></li>
			<li><a href="/user/follow">我的关注</a></li>
			<li><a href="/user/history">浏览历史</a></li>
			<li><a href="/user/password">修改密码</a></li>
		</ul>
	</div>

	<div class="col-xs-10">
		<div class="page-head white-block">
			<p>个人资料</p>
		</div>

		<div class="info-wrapper white-block">
			<form action="/user/update/{{ $user->id }}" method="post" enctype="multipart/form-data">
				<div class="headimg">
					<img src="/images/{{ $user->info->headimg }}">
					<input name="headimg" type="file" value="更改头像">
				</div>
				<div class="info">
					<p><span>用户名：</span>{{ $user->name }}</p>
					<p><span>邮箱地址：</span>{{ $user->email }}</p>
					<p><span>手机号：</span><input type="text" name="phone_number" value="{{ $user->info->phone_number }}"></p>
					<p><span>省：</span><input type="text" name="province" value="{{ $user->info->province }}"></p>
					<p><span>市：</span><input type="text" name="city" value="{{ $user->info->city }}"></p>
					<p><span>区：</span><input type="text" name="area" value="{{ $user->info->area }}"></p>
					<p><span>街道地址：</span><input type="text" name="address_detail" value="{{ $user->info->address_detail }}"></p>
					<p><span>注册时间：</span>{{ $user->created_at }}</p>
					<button type="submit">提交</button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection