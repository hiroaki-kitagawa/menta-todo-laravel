@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Todo修正</h1>

            @include('commons.error_messages')
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
                <div class="form-group">
                    {{ Form::select('status', ['未完了', '完了'], $todos->status)}}
                </div>
                {{Form::submit('更新')}}
            </form>
            <p><a href="/todo">Todo一覧</a></p>
        </div>
    </div>
</div>

@endsection
