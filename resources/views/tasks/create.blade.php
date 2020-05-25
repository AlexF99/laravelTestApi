@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (isset($message)):
                        <p>{{ $message }}</p>
                    @endif
                    <a href="/tasks">your tasks</a>
                    <form class="" action="/newtask" method="post">
                        @csrf
                        <input type="text" name="name" value="" placeholder="task name">
                        <input type="text" name="description" value="" placeholder="task description">
                        <button class="btn btn-primary" type="submit" name="button">create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
