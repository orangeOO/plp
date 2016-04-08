<!DOCTYPE html>
<html lang="zh">
  <head>
    <meta charset="utf-8">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>个人租借平台</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/offcanvas.css" rel="stylesheet">

  </head>

  <body>
    <nav class="navbar navbar-fixed-top navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="/">个人租借平台</a>
        </div>
        <div id="navbar">
          <ul class="nav navbar-nav navbar-right">
            @if (Auth::guest())
              <li><a href="{{ url('/auth/login') }}">登 录</a></li>
              <li><a href="{{ url('/auth/register') }}">注 册</a></li>
            @else
              <li><a href="{{ url('/user/index') }}">个人资料</a></li>
              <li><a href="{{ url('/user/goods') }}">我的发布</a></li>
              <li><a href="{{ url('/user/follow') }}">我的关注</a></li>
              <li><a href="{{ url('/user/history') }}">浏览历史</a></li>
              <li><a href="{{ url('/user/password') }}">修改密码</a></li>
              <li><a href="{{ url('/auth/logout') }}">{{ Auth::user()->name }} 退出</a></li>            
            @endif              
          </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </nav><!-- /.navbar -->

    <div class="container">
      @yield('contents')
      <hr>

      <footer>
        <p>&copy; OuYangJieQiong 2016</p>
      </footer>

    </div><!--/.container-->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>

    <script src="/js/offcanvas.js"></script>
  </body>
</html>
