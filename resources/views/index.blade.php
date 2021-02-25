@extends('layouts.app')

@section('css')
<link href="{{ asset('css/index.css') }}" rel="stylesheet">
@endsection

@section('content')
<h2 align="center" style="padding-top:20px; margin-bottom:22px;">商品列表</h2>

<div class='info'>

    @foreach($goods as $row)
        <div class='infoarea col-xs-4 col-sm-6 col-md-4 col-lg-3' style="height:470px;">

            <div style="height:380px;margin: auto;width: 240px;padding:0 20px;border-style: solid;border-width:1px;border-color: #BDB76B;">
                <ul>
                    <li class="img"><a href="goodsDetail?id={{ $row['gId'] }}"><img src="../storage/app/public/image/{{ $row['image'] }}"/></a></li>

                    <li class="pname" style="margin-bottom:0; height:80px;">
                        <a href="goodsDetail?id={{ $row['gId'] }}">
                            <p id="goodsName">{{ $row['name'] }}</p>
                        </a>
                    </li>

                    <li>價格：{{ $row['price'] }}</li>

                    <hr style="margin-bottom: 8px; margin-top: 8px;">

                    <li class="col3" style="margin-top:3px;">
                        <a id="add" class="add_cart" href="javascript:void(0)" 	onclick="addToCart({{ $row['gId'] }},'{{ $row['name'] }}','{{ $row['image'] }}','{{ $row['price'] }}',0,'list')">

                            <img src="../storage/app/public/image/add_to_cart.png" style="width:110px; height:28px;">
                        </a>

                    </li>
                </ul>
            </div>

        </div>
    @endforeach

</div>
@endsection
