@extends('layouts.app2')

@section('content')
<div class="container">
    @include('inc.message')

    <h2 align="center" style="margin-top: 30px;">修改商品</h2>

    {!! Form::open(['url' => 'manage/update/'.$product->id, 'style' => 'margin-left: 280px', 'enctype' => 'multipart/form-data']) !!}

    <div class="form-group">
        {{ Form::label('name', '名稱') }}
        {{ Form::text('名稱', $product->name, ['class' => 'form-control col-8']) }}
    </div>

    <div class="form-group">
        {{ Form::label('price', '價格') }}
        {{ Form::text('價格', $product->price, ['class' => 'form-control col-8']) }}
    </div>

    <div class="form-group">
        {{ Form::label('description', '描述') }}
        {{ Form::textarea('描述', $product->description, ['id' => 'article-ckeditor', 'class' => 'form-control col-8']) }}
    </div>

    <div class="form-group">
        {{Form::file('image')}}
    </div>

    {{ Form::submit('新增', ['class' => 'btn btn-success']) }}

    {{ Form::hidden('_method','PUT') }}
    {!! Form::close() !!}
</div>
@endsection
