<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controllers\Log;

use Auth;

class Todo extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'detail',
        'status'
    ];

    public function getTodo()
    {
        $data = Todo::where('user_id', Auth::id());

        return $data;
    }

    public function storeTodo($request, $id)
    {
        DB::beginTransaction();
        try {
            $todos = new Todo;
            $todos->user_id = $id;
            $todos->title = $request->title;
            $todos->detail = $request->detail;
            $todos->save();
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollback();
            \Log::error('タスクの追加に失敗しました。');
        }
    }

    public function updateTodo($request)
    {
        DB::beginTransaction();
        try {
            $todos = new Todo;
            $todos = Todo::find($request->id);
            $todos->title = $request->title;
            $todos->detail = $request->detail;
            $todos->status = $request->status;
            $todos->save();
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollback();
            \Log::error('タスクの編集に失敗しました。');
        }
    }

    public function deleteTodo($id)
    {
        DB::beginTransaction();
        try {
            Todo::destroy($id);
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            \Log::error('タスクの削除に失敗しました。');
        }
    }


}
