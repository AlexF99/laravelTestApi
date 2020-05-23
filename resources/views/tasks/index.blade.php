@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                @foreach ($tasks as $task):
                    <div class="card-body">
                        <div class="my-message">
                            <span><p>{{ $task->name }}{{ $task->description }}</p></span>
                            @if ($task->done):
                                <span>Feita</span>
                            @else:
                                <span>A fazer</span>
                            @endif;
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>
</div>
@endsection
