@extends('blog.layouts.app')
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
                                 src="{{env('BANNER') .'/'. $post->banner}}"
                                 @else
                                 src="{{ env('APP_URL') }}/storage/uploads/WIN_20211223_17_10_40_Pro.jpg"
                                 @endif
                                 alt="..."/></a>
                        <div class="card-body">
                            <div class="small text-muted">{{ $post->created_at->diffForHumans() }}</div>
                            <h2 class="card-title">{{ $post->title }}</h2>
                            <p class="card-text">{!! $post->content !!}</p>
                            <a class="btn btn-primary" href="{{ route('blog.post', $post->slug) }}">Read more →</a>
                        </div>
                    </div>
            @endforeach
            <!-- Nested row for non-featured blog posts-->
            {{--        <div class="row">--}}
            {{--            <div class="col-lg-6">--}}
            {{--                <!-- Blog post-->--}}
            {{--                <div class="card mb-4">--}}
            {{--                    <a href="#!"><img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg"--}}
            {{--                                      alt="..."/></a>--}}
            {{--                    <div class="card-body">--}}
            {{--                        <div class="small text-muted">January 1, 2021</div>--}}
            {{--                        <h2 class="card-title h4">Post Title</h2>--}}
            {{--                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis--}}
            {{--                            aliquid atque, nulla.</p>--}}
            {{--                        <a class="btn btn-primary" href="#!">Read more →</a>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--                <!-- Blog post-->--}}
            {{--                <div class="card mb-4">--}}
            {{--                    <a href="#!"><img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg"--}}
            {{--                                      alt="..."/></a>--}}
            {{--                    <div class="card-body">--}}
            {{--                        <div class="small text-muted">January 1, 2021</div>--}}
            {{--                        <h2 class="card-title h4">Post Title</h2>--}}
            {{--                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis--}}
            {{--                            aliquid atque, nulla.</p>--}}
            {{--                        <a class="btn btn-primary" href="#!">Read more →</a>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            {{--        </div>--}}


            <!-- Pagination-->
                @include('blog.layouts.pagination')

            </div>
            @include('blog.layouts.side-widgets')
        </div>
    </div>
@endsection
