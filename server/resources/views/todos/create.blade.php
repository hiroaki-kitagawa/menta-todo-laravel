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
        <div class="form-group">
            {{Form::label('statusInput', '状態')}}
            {{Form::checkbox('staus')}}
        </div>
        {{-- <button type="submit">新規追加</button> --}}
        {{Form::submit('新規追加')}}

    </form>


@endsection
