<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Task;
use App\User;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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

        $task->user()->associate($user)->save();
        return 'sucesso' . strval($task);
    }

    public function index()
    {
        $tasks = Task::all();
        if ($tasks->count() > 0) {
            return view('tasks/index', ['tasks' => $tasks]);
        }
        return 'no tasks';
    }
}
