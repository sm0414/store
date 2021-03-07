@extends('layouts.app2')

@section('content')
    <div class="container">
        <h2 align="center" style="margin-top: 30px;">會員資料</h2>

        <table style="margin-top: 50px;" class="table table-hover table-striped">

            <thead>
            <tr>
                <th>會員編號</th>
                <th>會員名字</th>
                <th>E-mail</th>
            </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                    @if($user['email'] != 'admin@gmail.com')
                        <tr>
                            <td onclick="goOrder({{ $user['id'] }})">{{ $user['id'] }}</td>
                            <td onclick="goOrder({{ $user['id'] }})">{{ $user['name'] }}</td>
                            <td onclick="goOrder({{ $user['id'] }})">{{ $user['email'] }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>

        </table>

    </div>
@endsection

@section('script')
function goOrder(id){
    window.location.href="/manage/member_orders/"+id;
}
@endsection
