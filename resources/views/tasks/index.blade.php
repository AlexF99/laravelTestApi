@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (isset($message)):
                <p>{{ $message }}</p>
            @endif
            <a href="/newtask">create new task</a>
            @foreach ($tasks as $task)
                <div class="row mb-3 p-3 bg-secondary rounded-sm">
                    <div class="col-8">
                        <div class="row">
                            <span class="col-2"><p>{{ $task->name }}</p></span><span class="col-6"><p>{{ $task->description }}</p></span>
                            @if ($task->done)
                                <span class="col-2">Feita</span>
                            @else
                                <span class="col-2 align-items-center">A fazer</span>
                            @endif
                            <div class="col-2">
                                <form action="/deleteTask" method="post">
                                    @csrf
                                    <button class="btn btn-primary" type="submit" name="id" value="{{ $task->id }}">delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="update-form">
                            <form class="row" action="/updateTask" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $task->id }}">
                                <div class="col-6">
                                    <input id="done" type="radio" name="done" value="1">
                                    <label for="done">done</label>
                                </div>
                                <div class="col-6">
                                    <input id="notdone" type="radio" name="done" value="0">
                                    <label for="notdone">not done</label>
                                </div>
                                <input type="text" name="name" value="" placeholder="task new name">
                                <input type="text" name="description" value="" placeholder="task new description">
                                <button class="btn btn-primary" type="submit" name="button">update</button>
                            </form>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
