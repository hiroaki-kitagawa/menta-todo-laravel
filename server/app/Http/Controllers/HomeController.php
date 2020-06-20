<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // return view('home');
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
}
