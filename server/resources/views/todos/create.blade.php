@extends('layouts.app')

@section('content')
    <h1>Todo新規追加</h1>

    <form method="post" action="/create">
        {{ csrf_field() }}
        <div class="form-group">
            {{Form::label('titleInput', 'タイトル')}}
            {{Form::text('title')}}
        </div>
        <div class="form-group">
            {{Form::label('detailInput', '内容')}}
            {{Form::textarea('detail')}}
        </div>

        {{Form::submit('登録')}}

    </form>


@endsection
