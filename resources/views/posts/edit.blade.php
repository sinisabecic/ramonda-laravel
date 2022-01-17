@extends('layouts.app2')

@section('content')

<h1>Edit Post</h1>

{!! Form::model($post, ['method' => 'PATCH', 'action' => ['PostsController@update', $post->id]]) !!}
@csrf
<div class="row">
    <div class="six columns">
        {!! Form::label('Post title', null, ['for' => 'title']) !!}
        {!! Form::text('Title', $post->title, ['id' => 'title', 'name' => 'title', 'class' => 'u-full-width',
        'placeholder' => 'Title'])
        !!}
    </div>
    <div class="six columns">

        {!! Form::label('Author', null, ['for' => 'author']) !!}

        <select class="u-full-width" name="user_id" id="author">

            <option value="{{ $post->author->id }}" selected>{{ $post->author->name }}</option>

            @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach

        </select>
    </div>
</div>

{!! Form::label('Content', null, ['for' => 'content']) !!}
{!! Form::textarea('Content', $post->content, ['id' => 'content', 'name' => 'content', 'class' => 'u-full-width',
'placeholder' => 'Hi Dave …'])
!!}

{!! Form::submit('Update post', ['class' => 'button-primary']) !!}
{!! link_to('posts', $title = 'Posts', $attributes = ['class' => 'button']) !!}

{!! Form::close() !!}


@endsection
