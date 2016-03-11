<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="/css/signin.css">
	<script src="/js/jquery.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<title>个人租借平台-登录</title>
</head>

<body>
	<div class="container">
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul style="color:red;">
        @foreach ($errors->all() as $error)
            <li>{{ $error  }}</li>
        @endforeach
        </ul>
    </div>
    @endif</li>
     	<form class="form-signin" method="POST" action="/auth/login">
            {!! csrf_field() !!}
	        <h2 class="form-signin-heading">登录个人租借平台</h2>
	        <label for="inputEmail" class="sr-only">邮件地址</label>
	        <input name="email" type="email" value="{{ old('email') }}"id="inputEmail" class="form-control" placeholder="请输入邮件地址" required autofocus>
	        <label for="inputPassword" class="sr-only">密码</label>
	        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="请输入密码" required>
	        <div class="checkbox">
	         	<label>
	            	<input name="remember" type="checkbox" value="remember-me"> 记住密码
	          	</label>
	        </div>
	        <button class="btn btn-lg btn-primary btn-block" type="submit">登 录</button>
            <a class="btn btn-lg btn-block" href="/auth/register">去 注 册</a>
      	</form>
    </div> <!-- /container -->
</body>
</html>
