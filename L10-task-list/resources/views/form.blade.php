@extends('layout.app')

@section('title', @isset($task) ? 'Update Task' : 'Task List')

@section('styles')
<style>
    .error-message{
        color: red;
        font-size: 0.8rem;
    }
</style>

@endsection

@section('content')
    <!-- {{$errors}} -->
    <form method="POST" 
    action="{{isset($task) ? route('task.update', ['task'=>$task->id]) : route('task.store')}}">        @csrf
       @csrf
        @isset($task)
        @method('PUT')
        @endisset
        <div>
            @error('title')
                <p class="error-message"> {{$message}}</p>
            @enderror
            <label for="title">
                Title
            </label>
            <input type="text" name="title" id="title" value="{{$task->title ?? old('title')}}">
        </div>

        <div>
            @error('description')
                <p class="error-message">{{$message}}</p>
            @enderror
            <label for="description">
                Description
            </label>
            <textarea name="description" id="description" rows="5">{{$task->description ?? old('description')}}</textarea>
        </div>
        <div>
            @error('long_description')
                <p class="error-message">{{$message}}</p>
            @enderror
            <label for="long_description">
                Long Description
            </label>
            <textarea name="long_description" id="long_description" rows="10">{{$task->long_description ?? old('long_description')}}</textarea>
        </div>
        <div>
            <a href="{{route('task.index')}}">Back</a>
        </div>
        <button type="submit">
            @isset($task)
                Update Task
            @else
                Add Task
            @endisset
        </button>
    </form>
@endsection