<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Task;
use App\User;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('tasks/create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:500',
            'description' => 'required|max:500',
            'done' => 'required|boolean',
        ]);
        if ($validator->fails()) {
            return 'erro de validacao' . strval($validator->errors());
        }

        $task = Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'done' => $request->done,
            'user_id' => auth()->id(),
        ]);

        $user = User::find(auth()->id());

        $task->user()->associate($user)->save();
        return $this->index();
    }

    public function index()
    {
        $tasks = DB::table('tasks')->where('user_id', auth()->id())->get();

        if ($tasks->count() > 0) {
            return view('tasks/index', ['tasks' => $tasks]);
        }
        return 'no tasks';
    }
}
