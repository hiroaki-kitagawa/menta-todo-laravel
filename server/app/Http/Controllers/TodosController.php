<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use Auth;

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

        $todos = new Todo;
        $todos->user_id = 1; // 一時的に値を固定
        $todos->title = $request->title;
        $todos->detail = $request->detail;
        $todos->status = $request->status;
        $todos->save();

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

        $todos = Todo::find($request->id);
        $todos->title = $request->title;
        $todos->detail = $request->detail;
        $todos->status = $request->status;
        $todos->save();

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
    public function destroy($id)
    {
        $todo = Todo::find($id);
        $todo->delete();
        $todos = Todo::where('user_id', Auth::id())->get();

        return view('todos.index', [
            'todos' => $todos,
        ]);

        // return view('todos.index');
    }

}
