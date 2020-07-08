<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use Auth;
use DB;

class TodosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $status = $request->input('status');

        $todo = new Todo;
        $query = $todo->getTodo();

        if (!empty($keyword)) {
            $query->where('title', 'LIKE', "%{$keyword}%");
        }

        if($status != 0) {
            $query->where('status', $status);
        }

        $todos = $query->get();
        return view('todos.index', [
            'todos' => $todos,
            'keyword' => $keyword,
            'status' => $status,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'detail' => 'required|max:4096',
        ]);

        $todo = new Todo;
        $todo->storeTodo($request, Auth::id());

        return view('todos.store');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $todos = Todo::find($id);
        return view('todos.edit', ['todos' => $todos]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'detail' => 'required|max:4096',
        ]);

        $keyword = $request->input('keyword');
        $status = $request->input('status');

        $todo = new Todo;
        $todo->updateTodo($request);

        $query = Todo::where('user_id', Auth::id());

        if (!empty($keyword)) {
            $query->where('title', 'LIKE', "%{$keyword}%");
        }

        if($status != 0) {
            $query->where('status', $status);
        }

        $todos = $query->get();
        return view('todos.index', [
            'todos' => $todos,
            'keyword' => $keyword,
            'status' => $status,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $todo = new Todo;
        $todo->deleteTodo($id);

        $keyword = $request->input('keyword');
        $status = $request->input('status');

        $query = Todo::where('user_id', Auth::id());

        if (!empty($keyword)) {
            $query->where('title', 'LIKE', "%{$keyword}%");
        }

        if($status != 0) {
            $query->where('status', $status);
        }

        $todos = $query->get();
        return view('todos.index', [
            'todos' => $todos,
            'keyword' => $keyword,
            'status' => $status,
        ]);

    }

    public function export(Request $request)
    {
        $headers = [ //ヘッダー情報
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=csvexport.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $callback = function()
        {

            $createCsvFile = fopen('php://output', 'w'); //ファイル作成

            $columns = [ //1行目の情報
                'id',
                'title',
                'detail',
                'status',
                'created_at'
            ];

            mb_convert_variables('SJIS-win', 'UTF-8', $columns); //文字化け対策

            fputcsv($createCsvFile, $columns); //1行目の情報を追記

            $bookingCurve = DB::table('todos');  // データベースのテーブルを指定

            $bookingCurveResults = $bookingCurve  //データベースからデータ取得
                ->select(['id', 'title', 'detail', 'status', 'created_at'])
                ->where('deleted_at', null)
                ->orderBy('created_at')
                ->get();

            foreach ($bookingCurveResults as $row) {  //データを1行ずつ回す
                $csv = [
                    $row->id,  //オブジェクトなので -> で取得
                    $row->title,
                    $row->detail,
                    $row->status,
                    $row->created_at,
                ];

                mb_convert_variables('SJIS-win', 'UTF-8', $csv); //文字化け対策

                fputcsv($createCsvFile, $csv); //ファイルに追記する
            }
            fclose($createCsvFile); //ファイル閉じる
        };

        return response()->stream($callback, 200, $headers); //ここで実行

    }

}
