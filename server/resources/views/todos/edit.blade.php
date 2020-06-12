@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                <div class="form-group">
                    <select name="status" id="">
                        @foreach(config('status') as $key => $status)
                            <option value="{{ $key }}">{{ $status['label'] }}</option>
                        @endforeach
                    </select>
                </div>
                {{Form::submit('更新')}}

            </form>
        </div>
    </div>
</div>

@endsection
