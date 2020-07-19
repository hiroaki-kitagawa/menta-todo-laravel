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

            <h3>CSV出力</h3>
            <div class="col-sm-10" style="padding:10px 0 20px 0; padding-left:0px;">
                <button onclick="CsvDownload()" id="csvdownload"  class="btn btn-success btn-sm  ml-2">CSVダウンロード</button>
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

        </div>
    </div>
</div>

<script>
    const CsvDownload = () =>{
        // alert('alert');
        $.ajax({
            type: 'GET',
            url: '/todo/csv',
        }).done(function (result) {
            window.location = '/todo/csv';
        }).fail(function (result) {
            alert('ファイルの取得に失敗しました。');
        });
    }
</script>

@endsection
