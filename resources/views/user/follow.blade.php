@extends('layouts.basic')

@section('contents')

<style>
	body{
		background-color: #f5f5f5;
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
	.goods-title{
		font-weight: bold;
		font-size: 12px;
		margin-top: 10px;
		margin-bottom: 10px;
	}
	.goods-price{
		font-weight: bold;
		font-size: 12px;
		margin-bottom: 10px;
	}
	.goods-cover{
		width: 180px;
		height: 160px !important;
	}
	.goods-time{
		color: rgb(153, 153, 153);
		height: 20px;
		font-size: 12px;
		margin-bottom: 10px;
	}
	.goods-control{
		font-size: 12px;
	}
	.price{
		color: #e4393c;
	}
	.history-wrapper{
		padding: 30px 20px;
	}
	.text-right{
		float: right;
	}
	.col-md-3{
		margin-bottom: 30px;
	}
	.active{
		color: rgb(228, 57, 60);
	}

</style>

<div class="row">
	<div class="col-md-2 nav">
		<ul>
			<li><a href="/user/index">个人资料</a></li>
			<li><a href="/user/goods">我的发布</a></li>
			<li class="active"><a href="/user/follow">我的关注</a></li>
			<li><a href="/user/history">浏览历史</a></li>
			<li><a href="/user/password">修改密码</a></li>
		</ul>
	</div>

	<div class="col-md-10">
		<div class="page-head white-block">
			<p>我的关注</p>
		</div>

		<div class="history-wrapper white-block">
			<div class="row">
				@foreach($follows as $follow)
					@if(empty($follow->goods->id))
					<div class="col-md-3">
						<a href="/goods/{{ $follow->goods_id }}">
							<img class="goods-cover" src="/images/default.jpeg" alt="封面图">
						</a>
						<p class="goods-title">
							<a href="/goods/{{ $follow->goods_id }}">物品已不存在</a>
						</p>
						<p class="goods-price"><span class="price">-.--</span>&nbsp;&nbsp;&nbsp;&nbsp;/每天</p>
						<div class="goods-time">
							<span>{{ substr($follow->created_at, 0, 10) }}</span>
							<span class="text-right">{{ substr($follow->created_at, 11) }}</span>
						</div>
						<p class="goods-control">
							<form method="post" action="/user/faviroute/{{ $follow->goods_id }}/unfollow">
								<button type="submit">取消关注</button>
							</form>
						</p>
					</div>					
					@else
					<div class="col-md-3">
						<a href="/goods/{{ $follow->goods->id }}">
							<img class="goods-cover" src="/images/{{ $follow->goods->cover }}" alt="封面图">
						</a>
						<p class="goods-title">
							<a href="/goods/{{ $follow->goods->id }}">{{ $follow->goods->title }}</a>
						</p>
						<p class="goods-price"><span class="price">{{ $follow->goods->price }}</span>&nbsp;&nbsp;&nbsp;&nbsp;/每天</p>
						<div class="goods-time">
							<span>{{ substr($follow->created_at, 0, 10) }}</span>
							<span class="text-right">{{ substr($follow->created_at, 11) }}</span>
						</div>
						<p class="goods-control">
							<form method="post" action="/user/faviroute/{{ $follow->goods->id }}/unfollow">
								<button type="submit">取消关注</button>
							</form>
						</p>
					</div>
					@endif
				@endforeach

			</div>
		</div>
	</div>
</div>

@endsection