@extends('layout.app')
@section('title', 'The List of Tasks!')

@section('content')
    <div>
        <a href="{{route('create.task')}}">Add A Task</a>
    </div>

@forelse($tasks as $task)
    <a href="{{route('task.show', ['task' => $task->id])}}">{{$task->title}}</a>
@empty
    <div>There are no tasks</div>
@endforelse
@if ($tasks->count())
    <nav>
        {{$tasks->links()}}
    </nav>
@endif
@endsection
