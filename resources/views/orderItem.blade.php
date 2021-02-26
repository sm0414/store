@extends('layouts.app')

@section('content')
    <h2 align="center" style="padding-top:20px;">訂單時間{{ $order->created_at }}</h2>

    <div style="margin-top: 30px;" class="container">
        <span class="float-right" style="margin-bottom: 7px;">
            <a class="btn btn-info" href="/orders">上一頁</a>
        </span>

        <table style="margin-top: 600px;" class="table table-hover table-striped">

            <thead>
                <tr>
                    <th colspan="2">商品</th>
                    <th>數量</th>
                    <th>小計</th>
                </tr>
            </thead>

            <tbody>
                @forelse($order->orderItems as $item)
                    <tr>
                        <td align="center" width="5%">
                            <img src="{{ asset('image/'.$item->product->image) }}" style="width: 135px; height: 135px;" />
                        </td>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->product_quantity }}</td>
                        <td>{{ $item->sum }}</td>
                    </tr>
                @empty
                @endforelse
            </tbody>

        </table>

    </div>
@endsection
