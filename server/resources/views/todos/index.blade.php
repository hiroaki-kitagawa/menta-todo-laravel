@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <h3>Todo検索</h3>
              <div class="col-sm-10" style="padding:20px 0; padding-left:0px;">
                <form class="form-inline ml-2" action="{{url('/todo')}}" method="GET">
                    <div class="form-group">
                    <input type="text" name="keyword" value="{{$keyword}}" class="form-control" placeholder="タイトルを入力してください">
                    </div>
                    <div>
                        {{ Form::select('status', ['全て','未完了', '完了'], $status, ['class' => 'ml-2'])}}
                    </div>
                    <input type="submit" value="検索" class="btn btn-info ml-2">
                </form>
            </div>

            <h3>Todo一覧</h3>

            @if (count($todos) > 0)
                <ul>
                    @foreach ($todos as $todo)
                        <li>{{ $todo->title}}</li>
                        <div class="form-inline">
                            <a href="/edit/{{ $todo->id }}" class="btn btn-success btn-sm  ml-2">編集</a>
                            <form method="post" action="/todo/destroy/{{$todo->id}}">
                                @csrf
                                <input type="submit" value="削除" class="btn btn-danger btn-sm  ml-2" onclick='return confirm("削除しますか？");'>
                            </form>
                        </div>
                    @endforeach
                </ul>

            @endif

            <p><a href="/create">新規追加</a></p>

            <h3>CSV出力</h3>

            <div id="app">
                <button @click="csvdownload"  class="btn btn-success btn-sm  ml-2">CSVダウンロード</button>
            </div>

            {!! Form::open(['action' => 'TodosController@export', 'method' => 'get', 'target' => '_blank']) !!}

            <input class="csv-download" type="submit" value="CSVダウンロード">

            {!! Form::close() !!}

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/vue@2.5.21/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    const app = new Vue({
        el: '#app',
        methods: {
            csvdownload: function(){
                axios.get('/todo/csv')
                .then(response => this.users = response.data)
                .catch(response => console.log(response))
            }
        },
    });
</script>

@endsection
