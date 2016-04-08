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
	.panel-default{
		min-width: 905px;
		border-radius: 1px;
		border: 1px solid #e5e5e5;
		box-shadow: none;
	}
	.panel-heading{
		font-size: 12px;
		border-bottom: none;
		height: 31px;
		line-height: 31px;
		padding-top: 0;
		padding-bottom: 0;
		background-color: #f5f5f5;
	}
	.panel-heading .time, .panel-heading .update-time{
		color: #aaa;
	}
	.panel-heading .update-time-label{
		margin-left: 30px;
	}
	.panel-body{
		padding: 0;
		font-size: 0;
	}
	.panel-body>div{
		border-left: 1px solid rgb(229, 229, 229);
		padding-top: 13px !important;
		height: 90px;
		vertical-align: top;
		display: inline-block;
		font-size: 12px;
	}
	.cover{
		border-left: none !important;
		padding: 15px 0 15px 15px;
	}
	.title{
		border-left: none !important;
		line-height: 18px;
		width: 280px;
		padding-top: 5px;
		padding-left: 10px;
		vertical-align: top;
	}
	.title a{
		color: inherit;
	}
	.price{
		width: 90px;
	}
	.price p{
		padding: 20px 0 0;
	}
	.term{
		width: 90px;
	}
	.term p{
		padding: 20px 0 0;
	}
	.views{
		color: #aaa;
		width: 90px;
	}
	.views p{
		margin: 0 7px;
		padding: 5px 0 5px;
	}
	.view-count{
		padding-bottom: 5px;
		border-bottom: 1px solid;
	}
	.status{
		width: 60px;
	}
	.status p{
		padding: 20px 0 0;
	}
	.control{
		width: 150px;
	}
	.control button{
		margin-top: 15px;
	}
	.control a{
		color: inherit;
	}
	.control form{
		display: inline-block;
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
				<span>我的发布<span>
				<span class="new"><a href="/goods/create">发布物品+</a></span>
			</p>
		</div>

		<div class="goods-wrapper white-block">
			<p class="bg-info">{{ $info or '' }}</p>
			@foreach($goodses as $goods)
				<div class="panel panel-default">
					<div class="panel-heading">
						<span class="time">{{ $goods->created_at }}</span>
						<span class="update-time-label">最近更新：</span>
						<span class="update-time">{{ $goods->updated_at }}</span>
					</div>
					<div class="panel-body">
						<div class="cover">
							<img width="60" height="60" src="/images/{{ $goods->cover }}">
						</div>
						<div class="title">
							<p><a href="/goods/{{ $goods->id }}">{{ $goods->title }}</a></p>
						</div>
						<div class="price text-center">
							<p>{{ $goods->price }}.00元 /每天</p>
						</div>
						<div class="term text-center">
							<p>租期 {{ $goods->term }}天</p>
						</div>
						<div class="views text-center">
							<p class="view-count">{{ $goods->hits }}次浏览</p>
							<p>{{ $goods->fans() }}人关注</p>
						</div>
						<div class="status text-center">
							<p>{{ $goods->status == 0 ? "已发布" : "已下架" }}</p>
						</div>
						<div class="control text-center">
							<button><a href="/goods/{{ $goods->id }}/edit">编辑</a></button>
							<form method="post" action="/goods/{{ $goods->id }}"><input type="hidden" name="_method" value="delete"><button type="submit">删除</button></form>
							<form method="post" action="/user/publish/{{ $goods->id }}"><button>{{ $goods->status == 0 ? "下架" : "发布" }}</button></form>
						</div>
					</div>
				</div>
			@endforeach
		</div>
	</div>
</div>

@endsection