@extends('layouts.basic')

@section('contents')

<style type="text/css">
  h2.goods-title{
    font-size: 18px;
  }
  .thumb{
    display: block;
    padding: 4px;
    margin-bottom: 20px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 4px;
  }
  .thumb>img{
    width: 250px;
    height: 150px;
    object-fit: cover;
  }
  .description{
    word-wrap: break-word;
    word-break: break-all;
    display: inline-block;
    width: 250px;
  }
  .box{
    height: 343px;
  }
</style>
<div class="row row-offcanvas row-offcanvas-right">

  <div class="col-sm-9">
    <p class="pull-right visible-xs">
      <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
    </p>
    <div class="jumbotron">
      @if( $current_type->name === '全部商品')
        <h2>欢迎光临</h2>
        <p>这是一个友好、有爱的平台。你可以在这里借到自己所需的物品，或者出租暂时不需要的闲置物品。让每件东西发挥出最大的价值，创造更多的美好是我们宗旨。</p>
      @else
        <h2>{{ $current_type->name }}</h2>
        <p>{{ $current_type->description }}</p>
      @endif
    </div>
    <div class="row">
      
      @foreach($goodses as $goods)
        <div class="col-lg-4 box">
          <h2 class="goods-title">{{ $goods->title }}</h2>
          <a href="/goods/{{ $goods->id }}" class="thumb">
            <img src="/images/{{ $goods->cover }}" alt="{{ $goods->title }}">
          </a>
          <p class="description">{{ mb_strimwidth($goods->description, 0, 100, '...', 'utf-8') }}</p>
          <p><a class="btn btn-default" href="/goods/{{ $goods->id }}" role="button">查看详情 &raquo;</a></p>
        </div><!--/.col-xs-6.col-lg-4-->
      @endforeach

    </div><!--/row-->
  </div><!--/.col-xs-12.col-sm-9-->

  <div class="col-sm-3 sidebar-offcanvas" id="sidebar">
    <div class="list-group">
      @foreach($types as $type)
        <a href="{{ $type->id == 1 ? '/' : '/type/'.$type->id }}" class="list-group-item {{ $type->id == $current_type->id ? 'active' : '' }}">{{ $type->name }}</a>
      @endforeach
    </div>
  </div><!--/.sidebar-offcanvas-->
</div><!--/row-->
@endsection