<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        $todos = new Todo;
        $todos->user_id = $id;
        $todos->title = $request->title;
        $todos->detail = $request->detail;
        $todos->save();
    }

    public function updateTodo($request)
    {
        $todos = new Todo;
        
        $todos = Todo::find($request->id);
        $todos->title = $request->title;
        $todos->detail = $request->detail;
        $todos->status = $request->status;
        $todos->save();
    }


}
