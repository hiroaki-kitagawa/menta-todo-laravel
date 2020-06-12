@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Todo新規追加</h1>

            @include('commons.error_messages')
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
        </div>
    </div>
</div>

@endsection
