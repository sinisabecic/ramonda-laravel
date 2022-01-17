@extends('layouts.app')


@section('content')

{{--!napomena: Form::open ili Form::model($post) svejedno--}}
<div class="row">

    <ul class="list-group list-group-flush">

        @foreach ($posts as $post)

        <li class="list-group-item">
            <h3>{{ $post->title }}</h3>

            <ul class="list-group list-group-horizontal list-group-flush">

                <li class="list-group-item">
                    <img height="100px" src="{{ $post->path }}" alt="{{ $post->path }}">
                </li>

                <li class="list-group-item">
                    <a class="btn btn-primary" href="{{ route('posts.show', $post->id) }}">Show</a>
                </li>

                <li class="list-group-item">
                    <a class="btn btn-success" href="{{ route('posts.edit', $post->id) }}">Edit</a>
                </li>

                @if ($post->deleted_at)
                <li class="list-group-item">
                    {!! Form::open(['method' => 'PATCH', 'action' => ['PostsController@restore', $post->id]]) !!}
                    {!! Form::submit('Restore', ['class' => 'btn btn-secondary px-2']) !!}
                    {!! Form::close() !!}
                </li>
                @else
                <li class="list-group-item">
                    {!! Form::open(['method' => 'DELETE', 'action' => ['PostsController@destroy', $post->id]]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger px-2']) !!}
                    {!! Form::close() !!}
                </li>
                @endif
            </ul>
        </li>
        @endforeach
    </ul>



    @endsection
