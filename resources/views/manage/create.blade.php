@extends('layouts.app2')

@section('content')
<div class="container">
    @include('inc.message')

    <h2 align="center" style="margin-top: 30px;">新增商品</h2>

    {!! Form::open(['url' => 'manage/store', 'style' => 'margin-left: 280px', 'enctype' => 'multipart/form-data']) !!}

    <div class="form-group">
        {{ Form::label('name', '名稱') }}
        {{ Form::text('名稱', '', ['class' => 'form-control col-8']) }}
    </div>

    <div class="form-group">
        {{ Form::label('price', '價格') }}
        {{ Form::text('價格', '', ['class' => 'form-control col-8']) }}
    </div>

    <div class="form-group">
        {{ Form::label('description', '描述') }}
        {{ Form::textarea('描述', '', ['class' => 'form-control col-8']) }}
    </div>

    <div class="form-group">
        {{Form::file('image')}}
    </div>

    {{ Form::submit('新增', ['class' => 'btn btn-success']) }}

    {!! Form::close() !!}

</div>


@endsection
