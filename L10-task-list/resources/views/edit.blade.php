@extends('layout.app')

@section('content')
    <!-- {{$errors}} -->
    @include('form', ['task' => $task])
@endsection