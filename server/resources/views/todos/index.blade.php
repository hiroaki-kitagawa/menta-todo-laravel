@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Todo一覧</h1>

            @if (count($todos) > 0)
                <ul>
                    @foreach ($todos as $todo)
                        <li>{{ $todo->title}}</li>
                        <a href="/edit/{{ $todo->id }}">編集</a>
                    @endforeach
                </ul>

            @endif

            <p><a href="/create">新規追加</a></p>
        </div>
    </div>
</div>

@endsection
