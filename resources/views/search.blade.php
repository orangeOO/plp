@extends('layouts.basic')

@section('contents')

<style type="text/css">
  h2.goods-title{
    font-size: 18px;
  }
</style>
<div class="row row-offcanvas row-offcanvas-right">

  <div class="col-xs-12 col-sm-9">
    <p class="pull-right visible-xs">
      <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
    </p>
    <div class="jumbotron">
      <h2>"{{ $keyword}}" 的搜索结果</h2>
      <p>共找到 {{ count($goodses) }} 个物品</p>
    </div>
    <div class="row">
      
      @foreach($goodses as $goods)
        <div class="col-xs-6 col-lg-4">
          <h2 class="goods-title">{{ $goods->title }}</h2>
          <a href="/goods/{{ $goods->id }}" class="thumbnail">
            <img src="/images/{{ $goods->cover }}" alt="{{ $goods->title }}">
          </a>
          <p>{{ mb_strimwidth($goods->description, 0, 100, '...', 'utf-8') }}</p>
          <p><a class="btn btn-default" href="/goods/{{ $goods->id }}" role="button">查看详情 &raquo;</a></p>
        </div><!--/.col-xs-6.col-lg-4-->
      @endforeach

    </div><!--/row-->
  </div><!--/.col-xs-12.col-sm-9-->

</div><!--/row-->
@endsection