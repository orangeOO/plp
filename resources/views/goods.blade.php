@extends('layouts.basic')

@section('contents')

<style type="text/css">
  ul{
    list-style: none;
    margin: 0px;
    padding: 0px;
  }

  .info{
    color: rgb(51, 51, 51);
    font-size: 15px;
  }

  .info li{
    height: 36px;
  }

  .info .left{
    display: inline-block;
    width: 80px;
  }

  .info hr{
    margin: 0 0 10px 0;
  }

  .goods-title{
    font-size: 22px;
    line-height: 31px;
    font-weight: bold;
  }

  .trade-info{
    line-height: 21px;
  }

  .price-mark{
    font-size: 24px;
  }

  .price{
    font-size: 24px;
    color: rgb(255, 68, 0);
  }

  .description{
    font-size: 15px;
    line-height: 26px;
  }

  .description hr{
    margin-top: 0;
  }

  .comments{
    margin-top: 50px;
  }

  .comments hr{
    margin-top: 0;
  }

  .media{
    padding-top: 12px;
    border-top: 1px dashed #d5d5d5;
  }

  .media-body{
    position: relative;
  }

  .media-body p{
    width: 100%;
    position: absolute;
    bottom: 0px;
    margin: 0px;
  }

  .reply-button{
    float: right;
  }

  .comments .media-heading{
    color: rgb(102, 102, 102);
    font-size: 14px;
  }

  .comments .media .created-time{
    font-size: 14px;
    color: rgb(172, 172, 172);
  }

  .well{
    border-radius: 1px;
    padding: 10px;
  }

  .well img{
    vertical-align: top;
    display: inline-block;
  }

  .well textarea{
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    display: inline-block;
    height: 65px;
    width: 660px;
  }

  .focus{
    width: 137px;
    height: 38px;
    line-height: 38px;
    text-align: center;
    color: #fff;
    border: none;
    background-color: #e4393c;
    /*border-radius: 1px;*/
  }

</style>

<div class="row row-offcanvas row-offcanvas-right">

  <div class="col-xs-8">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img src="/images/{{ $goods->cover }}">
        </div>
        @foreach(json_decode($goods->images) as $image)
          <div class="item">
            <img src="/images/{{ $image }}">
          </div>
        @endforeach
      </div>

      <!-- Controls -->
      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>

    <div class="description">
      <h3>详细信息</h3>
      <hr>
      <p>{{ $goods->description }}</p>
    </div>

    <div class="comments">
      <h3>留言</h3>
      <hr>

      <div class="well well-lg">
        <img width="64px" height="64px" src="/images/default.jpeg">
        <textarea placeholder="我也来说两句..."></textarea>
        <div class="text-right">
          <button>留言</button>
        </div>
      </div>

      <div class="media">
        <div class="media-left media-middle">
          <a href="#">
            <img width="48px" height="48px" class="media-object" src="/images/default.jpeg" alt="...">
          </a>
        </div>
        <div class="media-body">
          <h4 class="media-heading">abcdefg  包邮到付</h4>
          <p><span class="created-time">2016-04-06 13:25:21</span><span class="reply-button"><a href="">回复</a></span></p>
        </div>
      </div>

      <div class="media">
        <div class="media-left media-middle">
          <a href="#">
            <img width="48px" height="48px" class="media-object" src="/images/default.jpeg" alt="...">
          </a>
        </div>
        <div class="media-body">
          <h4 class="media-heading">2333 回复 abcedfg  没问题</h4>
          <p><span class="created-time">2016-04-06 13:25:21</span><span class="reply-button"><a href="">回复</a></span></p>
        </div>
      </div>

      <div class="media">
        <div class="media-left media-middle">
          <a href="#">
            <img width="48px" height="48px" class="media-object" src="/images/default.jpeg" alt="...">
          </a>
        </div>
        <div class="media-body">
          <h4 class="media-heading">哈哈哈  能少点吗</h4>
          <p><span class="created-time">2016-04-06 13:25:21</span><span class="reply-button"><a href="">回复</a></span></p>
        </div>
      </div>
    </div>

  </div>

  <div class="col-xs-4 info">
    <h3 class="goods-title">{{ $goods->title }}</h3>
    <ul class="trade-info">
      <li><span class="left" >出&nbsp;&nbsp;租&nbsp;&nbsp;价：</span><b class="price-mark">￥</b><span class="price">{{ $goods->price }}.00</span> /每天</li>
      <li><span class="left" >期&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;限：</span>{{ $goods->term }}天</li>
      <hr>
      <li><span class="left" >所&nbsp;&nbsp;在&nbsp;&nbsp;地：</span>{{ $goods->user->info->province }}{{ $goods->user->info->city }}&nbsp;&nbsp;&nbsp;&nbsp;{{ $goods->user->info->area }}</li>
      <li><span class="left" >联系方式：</span>{{ $goods->user->info->phone_number }}</li>
      <hr>
      <li><span class="left" >更新时间：</span>{{ $goods->updated_at }}</li>
      <li><span class="left" >浏&nbsp;&nbsp;览&nbsp;&nbsp;数：</span>{{ $goods->hits }}次</li>
      <li><span class="left" >关&nbsp;&nbsp;注&nbsp;&nbsp;数：</span>{{ $goods->fans() }}人</li>
    </ul>
    @if($goods->isFocused())
    <form method="post" action="/user/faviroute/{{ $goods->id }}/follow"><button type="submit" class="focus">加 入 关 注</button></form>
    @else
    <form method="post" action="/user/faviroute/{{ $goods->id }}/unfollow"><button type="submit" class="focus">取 消 关 注</button></form>
    @endif
  </div>


</div><!--/row-->

@endsection