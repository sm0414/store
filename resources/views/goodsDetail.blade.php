@extends('layouts.app')

@section('css')
<link href="{{ asset('css/goodsDetail.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="text3 title" align="center">{{ $product['name'] }}</div><br><br>
    <table width="100%" border="0" align="center">
        <tr>
            <td width="40%" align="right">
                <div><img src="{{ asset('storage/image/'.$product['image']) }}" width="360px" height="360px"/></div>
                <br>
            </td>

            <td>
                <div style="width:80%; height:200;">
                    <dl style="margin-left:100px;">
                        <dd style="width:25%;"><h4>特色：</h4></dd>
                        <dd style="width:70%; margin-left:30px;">{!! $product['description'] !!}</dd>
                    </dl>
                </div>

                <div align="center" class="text4">價格：<span class="title">{{ $product['price'] }}元</span></div>

                <br>

                <div style="float:left; margin-left:150px; margin-top:40px;">
                    <a href="javascript:void(0)" onclick="addToCart({{ $product['id'] }})">
                    <img src="https://store-by-laravel.s3.us-east-2.amazonaws.com/images/add_to_cart.png" style="width:185px; height:50px;"></a>
                </div>
            </td>
        </tr>
    </table>
@endsection

@section('script')
function addToCart(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "get",
        url: "/add-to-cart/"+id,
    }).then(function(e){
            alert("商品已加入購物車！！");
    })
}
@endsection
