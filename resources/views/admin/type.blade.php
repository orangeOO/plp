@extends('layouts.admin')

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
			<li><a href="/admin/index">用户管理</a></li>
			<li><a href="/admin/goods">物品管理</a></li>
			<li  class="active"><a href="/admin/type">分类管理</a></li>
			<li><a href="/admin/password">修改密码</a></li>
		</ul>
	</div>

	<div class="col-xs-10">
		<div class="page-head white-block">
			<p>
				<span>分类管理<span>
			</p>
		</div>
	
		<div class="goods-wrapper white-block">
			<form method="post" action="/user/reset">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>分类名</th>
							<th>描述</th>
							<th>创建时间</th>
							<th>操作</th>
						</tr>						
					</thead>
					<tbody>
						@foreach($types as $type)
						<tr>
							<th>{{ $type->id }}</th>
							<td>{{ $type->name }}</td>
							<td>{{ $type->description }}</td>
							<td>{{ $type->created_at }}</td>
							<td>
								<a href="/admin/edittype?id={{ $type->id }}">编辑</a>
								<a href="/admin/deltype?id={{ $type->id }}">删除</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</form>

			<form method="POST" action="/admin/addtype" class="form-inline">
			  <div class="form-group">
			    <label for="exampleInputName2">分类名</label>
			    <input name="name" type="text">
			  </div>
			  <div class="form-group">
			    <label for="exampleInputEmail2">描述</label>
			    <input name="description" type="text">
			  </div>
			  <button type="submit" >添加</button>
			</form>

		</div>


	</div>
</div>

@endsection