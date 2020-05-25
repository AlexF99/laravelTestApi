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
                            <button class="btn" type="submit" name="id" value="{{ $task->id }}">delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
