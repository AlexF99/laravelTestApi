<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Task;

class TaskController extends Controller
{
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

        $task = Task::Create([
            'name' => $request->name,
            'description' => $request->description,
            'done' => $request->done,
        ]);
        return 'sucesso';
    }
}
