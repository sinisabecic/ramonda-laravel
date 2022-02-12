@extends('blog.layouts.app')
@section('page-title', env("APP_NAME"))
@section('content')
    <!-- Blog entries-->
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
            @foreach($posts as $post)
                <!-- Featured blog post-->
                    <div class="card mb-4">
                        <a href="{{ route('blog.post', $post->slug) }}">
                            <img class="card-img-top"
                                 @if($post->banner)
                                 src="{{env('BANNER') .'/'. $post->slug .'/'. $post->banner}}"
                                 @else
                                 src="{{ env('APP_URL') }}/storage/uploads/WIN_20211223_17_10_40_Pro.jpg"
                                 @endif
                                 alt="..."/></a>
                        <div class="card-body">
                            <div class="small text-muted">{{ $post->created_at->diffForHumans() }}</div>
                            <a class="text-dark text-decoration-none" href="{{ route('blog.post', $post->slug) }}">
                                <h2 class="card-title">{{ $post->title }}</h2>
                            </a>
                            <p class="card-text">{!! Str::limit($post->content, 600, ' (...)') !!}</p>
                            <a class="btn btn-primary" href="{{ route('blog.post', $post->slug) }}">Read more →</a>
                        </div>
                    </div>
            @endforeach
            <!-- Nested row for non-featured blog posts-->

                @include('blog.layouts.pagination')

            </div>
            @include('blog.layouts.side-widgets')
        </div>
    </div>
@endsection
