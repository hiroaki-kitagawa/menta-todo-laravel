@extends('layouts.app')

@section('content')
    <h1>Todo修正</h1>

    <form action="/edit" method="post">
        @csrf
        <input type="hidden" class="form-control" name="id" value="{{ $todos->id }}">
        <div class="form-group">
            {{Form::label('titleInput', 'タイトル')}}
            <input type="text" class="form-control" id="titleInput" name="title" value="{{ $todos->title }}">
        </div>
        <div class="form-group">
            <label for="detailInput">内容</label>
            <textarea class="form-control" id="detailInput" rows="3" name="detail">{{ $todos->detail }}</textarea>
        </div>
        {{Form::submit('更新')}}

    </form>


@endsection
