@extends('layouts.app2')

@section('content')
    <h2 align="center" style="padding-top:20px;">會員 訂單記錄</h2>

    <div style="margin-top: 30px;" class="container">
        <table style="margin-top: 50px;" class="table table-hover table-striped">

            <thead>
                <tr>
                    <th>訂單時間</th>
                    <th>商品數量</th>
                    <th>總價</th>
                </tr>
            </thead>

            <tbody>
                @forelse($orders as $order)
                    <tr onclick="goToOrderItem({{ $order->id }})">
                        <td>{{ $order->created_at }}</td>
                        <td>{{ count($order->orderItems) }}</td>
                        <td>{{ $order->total }}</td>
                    </tr>
                @empty
                @endforelse
            </tbody>

        </table>

    </div>
@endsection

@section('script')
    function goToOrderItem(id){
        window.location = "manage/member_orders/item/"+id;
    }
@endsection
