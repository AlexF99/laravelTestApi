@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (isset($message)):
                <p>{{ $message }}</p>
            @endif
            <a class="btn btn-primary mb-2" href="/newtask">create new task</a>
            @foreach ($tasks as $task)
                <div class="row mb-3 p-3 rounded-sm" style="background-color: #eee;">
                    <div class="col-12">
                        <div class="row">
                            <span class="col-2"><p>{{ $task->name }}</p></span><span class="col-5"><p>{{ $task->description }}</p></span>
                            @if ($task->done)
                                <span class="col-2">Status: Done</span>
                            @else
                                <span class="col-2">Status: Not done</span>
                            @endif
                            <div class="col-1">
                                <form action="/deleteTask" method="post">
                                    @csrf
                                    <button class="btn btn-primary" type="submit" name="id" value="{{ $task->id }}">delete</button>
                                </form>
                            </div>
                            <div class="col-1">
                                <input type="button" class="btn btn-primary" id="activate-update-form" value="update">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3 update-form unactive">
                        <form class="row" action="/updateTask" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $task->id }}">
                            <div class="col-1">
                                <input id="done" type="radio" name="done" value="1">
                                <label for="done">done</label>
                            </div>
                            <div class="col-2">
                                <input id="notdone" type="radio" name="done" value="0">
                                <label for="notdone">not done</label>
                            </div>
                            <input style="height: 33px;" class="col-3" type="text" name="name" value="" placeholder="task new name">
                            <input style="height: 33px;" class="col-4" type="text" name="description" value="" placeholder="task new description">
                            <button style="height: 33px;" class="col-2 btn btn-primary" type="submit" name="button">update</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
