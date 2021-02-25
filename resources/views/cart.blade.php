@extends('layouts.app')

@section('css')
<link href="{{ asset('css/cart.css') }}" rel="stylesheet">
@endsection('css')

@section('content')
    <h2 align="center" style="padding-top:20px;">購物車</h2>

    <form id="form" action="cartPost" method="POST" class="col-11" style="margin: auto;">
        @csrf
        <br>
        <table width="100%" border="1" align="center" class="threeboder">
            <tr bgcolor="#A5D3FF">
                <td height="50" align="center" class="theader" colspan="2">商品名稱</td>
                <td width="8%" align="center" class="theader">數量</td>
                <td width="15%" align="center" class="theader">單價</td>
                <td width="15%" align="center" class="theader">小計</td>
                <td width="5%" align="center" class="theader">清除</td>
            </tr>

            @if(session()->has('cart'))
                @foreach($items as $id => $item)
                    <tr style="height:150px;">
                        <td><img src="../storage/app/public/image/{{ $item['image'] }}" style="width:100px; height:100px;" /></td>
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
                <td height="50" colspan="6" align="right">合計：$<span id="total">{{ $totalPrice }}</span>  </td>
            </tr>
        </table>

        <br>

        <div align="center">
            <button id="checkout" name="total" value="{{ $totalPrice }}" type="submit" class="btn btn-success">結帳</button>
        </div>

    </form>
@endsection
