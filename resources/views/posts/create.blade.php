@extends('layouts.app2')

@section('content')

<h1>Create Post</h1>

@if ($errors->any())
<ul>
    @foreach ($errors->all() as $error)
    <li class="alert alert-error">
        {{ $error }}
    </li>
    @endforeach
</ul>
@endif

{{-- open ide za create --}}
{!! Form::open(['method' => 'POST', 'action' => 'PostsController@store', 'files' => true]) !!}
@csrf

<div class="row">

    <div class="six columns">

        {!! Form::label('title', 'Title:', ['for' => 'title']) !!}
        {!! Form::text('title', null, ['class' => 'u-full-width','id' => 'title','placeholder' => 'Title']); !!}

    </div>
    <div class="six columns">
        {!! Form::label('title', 'Author:', ['for' => 'roles']) !!}
        <select class="u-full-width" name="user_id" id="roles">

            @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach

        </select>
    </div>
</div>

{!! Form::label('Content:', null, ['for' => 'content']) !!}
{!! Form::textarea('Content', null, ['id' => 'content', 'name' => 'content', 'class' => 'u-full-width',
'placeholder' => 'Hi Dave …']) !!}

{!! Form::submit('Add post', ['class' => 'button-primary']) !!}
{!! link_to('posts', $title = 'Posts', $attributes = ['class' => 'button']) !!}

{{-- File --}}
{!! Form::label('file', 'File:', ['for' => 'file']) !!}
{!! Form::file('file', ['class' => 'u-full-width','id' => 'file','placeholder' => 'File']); !!}

{!! Form::close() !!}


@endsection
