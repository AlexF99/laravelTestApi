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
        ]);
        if ($validator->fails()) {
            return 'validation error!' . strval($validator->errors());
        }

        $task = Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'done' => 0,
            'user_id' => auth()->id(),
        ]);

        $user = User::find(auth()->id());

        $task->user()->associate($user)->save();
        return view('tasks/create', ['message' => 'task created successfully!']);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'name' => 'max:500',
            'done' => 'boolean',
            'description' => 'max:500',
        ]);
        if ($validator->fails()) {
            return 'validation error!' . strval($validator->errors());
        }
        $task = Task::find($request->id);
        if ($request->has('name') && $request->name != '') {
            $task->name = $request->name;
        }
        if ($request->has('description') && $request->description != '') {
            $task->description = $request->description;
        }
        if ($request->has('done')) {
            $task->done = $request->done;
        }

        $task->save();
        return redirect('/tasks');
    }

    public function show(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return 'validation error!' . strval($validator->errors());
        }

        $task = Task::find($request->id);

        if(!$task) {
            return 'task not found';
        }

        return json_encode($task);
    }

    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return 'validation error!' . strval($validator->errors());
        }

        $task = Task::find($request->id);
        if (!$task) {
            return redirect('/tasks');
        }
        $task->delete();
        return redirect('/tasks');
    }

    public function index()
    {
        $tasks = DB::table('tasks')->where('user_id', auth()->id())->get();

        if ($tasks->count() > 0) {
            return view('tasks/index', ['tasks' => $tasks]);
        }
        return view('tasks/create', ['message' => 'you have no tasks yet, create some!']);
    }
}
