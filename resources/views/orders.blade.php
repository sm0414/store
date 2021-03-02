@extends('layouts.app')

@section('content')
    <div style="margin-top: 30px;" class="container">
        <h2 align="center" style="padding-top:20px;">訂單記錄</h2>

        @include('inc.message')

        <table style="margin-top: 50px;" class="table table-hover table-striped">

            <thead>
                <tr>
                    <th>訂單編號</th>
                    <th>訂單時間</th>
                    <th>品項</th>
                    <th>總價</th>
                </tr>
            </thead>

            <tbody>
                @forelse($orders as $order)
                    <tr onclick="goToOrderItem({{ $order->id }})">
                        <td>{{ $order->order_number }}</td>
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
        window.location = "/order/"+id;
    }
@endsection
