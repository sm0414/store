@extends('layouts.app')

@section('css')
<link href="{{ asset('css/cart.css') }}" rel="stylesheet">
@endsection('css')

@section('content')
    <div style="margin-top: 20px;" class="container">
        <h2 align="center">購物車</h2>

        @include('inc.message')

        <form id="form" action="/checkout" method="POST">
            @csrf
            <br>
            <table width="100%" border="1" align="center" class="threeboder">
                <tr bgcolor="#A5D3FF">
                    <td height="50" align="center" class="theader" colspan="2">商品名稱</td>
                    <td width="10%" align="center" class="theader">數量</td>
                    <td width="10%" align="center" class="theader">單價</td>
                    <td width="10%" align="center" class="theader">小計</td>
                    <td width="5%" align="center" class="theader">清除</td>
                </tr>

                @if(session()->has('cart'))
                    @foreach($items as $id => $item)
                        <tr style="height:150px;">
                            <td align="center" width="15%">
                                <img src="{{ asset('storage/image/'.$item['image']) }}" style="width: 150px; height: 150px;" />
                            </td>
                            <td height="50" align="left" class="trow"> {{ $item['name'] }} </td>
                            <td height="50" align="center" class="trow">
                                {{ $item['quantity'] }}
                                <br>
                                <a href="/increase-one/{{ $id }}" class="btn btn-sm btn-success" role="button" aria-pressed="true">+</a>
                                <a href="/decrease-one/{{ $id }}" class="btn btn-sm btn-danger" role="button" aria-pressed="true">-</a>
                            </td>
                            <td align="center" class="trow"><span>{{ $item['sum']/$item['quantity'] }}</span></td>
                            <td align="center" class="trow"><span>{{ $item['sum'] }}</span></td>
                            <td class="text-center"><a class="btn btn-outline-success btn-sm" href="/remove-item/{{ $id }}">刪除</a></td>
                        </tr>
                    @endforeach
                @endif

                <tr>
                    <td height="50" colspan="6" align="right" style="padding-right: 8px;">
                        <span id="total">合計：${{ $totalPrice }}</span>
                    </td>
                </tr>
            </table>

            <br>

            <div align="center">
                <a id="checkout" name="total" onclick="submitForm({{ $totalPrice }})" class="btn btn-success">結帳</a>
            </div>

        </form>
    </div>

@endsection

@section('script')
function submitForm(totalPrice){
    if(totalPrice == 0){
        alert('購物車內沒有商品');
    }else{
        document.getElementById("form").submit()
    }
}
@endsection
