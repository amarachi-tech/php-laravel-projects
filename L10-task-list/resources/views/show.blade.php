
@extends('layout.app')

@section('title')

    {{$task->title}}
@endsection

@section('content')
<p>{{$task ->description}}</p>
@if ($task ->long_description)
    <p>{{$task ->long_description}}</p>
@endif
<p>{{$task ->completed}}</p>
<p>{{$task -> created_at}}</p>
<p>{{$task -> updated_at}}</p>

@if ($task->completed)
    <p>completed</p>
@else
    <p>Not completed</p>
@endif

<div >
    <a href="{{route('task.edit', ['task'=>$task])}}">Edit</a>
</div>
<div >
    <a href="{{route('task.index')}}">Home</a>
</div>
<div>
    <form method="POST" action="{{route('task.toggle-complete', ['task'=>$task])}}">
    @csrf
    @method('PUT')
    <button type="submit">
        Mark as {{$task->completed ? 'not completed' : 'completed'}}
    </button>
    </form>
</div>
<div>
    <form action="{{route('task.destroy', ['task' => $task->id])}}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
</div>
@endsection