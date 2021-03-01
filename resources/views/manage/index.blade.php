@extends('layouts.app2')

@section('content')
    <div class="container col-10">
        <h2 align="center" style="margin-top: 30px;">商品資料</h2>

        <span class="float-right" >
            <a class="btn btn-info" href="create">新增商品</a>
        </span>

        <table style="margin-top: 50px;" class="table table-hover table-striped">

            <thead>
                <tr>
                    <th>商品</th>
                    <th style="width:455px;">名稱</th>
                    <th style="width:80px;">價錢</th>
                    <th style="width:505px;">說明</th>
                    <th style="width:70px;"></th>
                </tr>
            </thead>

            <tbody>
            @forelse($goods as $row)
                <tr>
                    <td><img src="{{ asset('storage/image/'.$row['image']) }}" style="width:210px;height:210px;"></td>
                    <td>{{ $row['name'] }}</td>
                    <td>{{ $row['price'] }}</td>
                    <td>{!! $row['description'] !!}</td>
                    <td>
                        <span class="float-right">
                            <a class=" btn btn-outline-success btn-sm" style="margin-bottom: 3px;" href="edit/{{ $row['id'] }}">修改</a>
                            <a class="btn btn-danger btn-sm" onclick="deleteProduct({{ $row['id'] }})">刪除</a>
                        </span>
                    </td>
                </tr>
            @empty
            @endforelse
            </tbody>

        </table>

    </div>
@endsection

@section('script')
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

function goDelete(id){
    $.ajax({
        type: "post",
        url: "/delete",
        data: {id: id}
    }).then(function(e){
        parent.location.reload();
    })
}
@endsection