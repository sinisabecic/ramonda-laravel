@extends('blog.layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8">
                <!-- Post content-->
                <article id="article">
                    <!-- Post header-->
                    <header class="mb-4">
                        <!-- Post title-->
                        <h1 class="fw-bolder mb-1">{{ $post->title }}</h1>
                        <!-- Post meta content-->
                        <div class="text-muted fst-italic mb-2">Posted on {{ $post->created_at->format('d.m.Y.') }}
                            by {{ $post->author->name }}</div>

                        <!-- Post tags-->
                        @foreach($post->tags as $tag)
                            <a class="badge bg-secondary text-decoration-none link-light" href="#!">{{ $tag->name }}</a>
                        @endforeach
                    </header>
                    <!-- Preview image figure-->
                    <figure class="mb-4"><img class="img-fluid rounded"
                                              @if($post->banner)
                                              src="{{env('BANNER') .'/'. $post->slug .'/'. $post->banner}}"
                                              @else
                                              src="{{ env('APP_URL') }}/storage/uploads/WIN_20211223_17_10_40_Pro.jpg"
                                              @endif
                                              alt="..."/>
                    </figure>
                    <!-- Post content-->
                    <section class="mb-5">
                        <p class="fs-5 mb-4">{!! $post->content !!}</p>
                    </section>
                </article>

                <!-- Comments section-->
                {{--                @include('blog.comments')--}}
                <div id="disqus_thread" class="mb-5"></div>

            </div>
            <!-- Side widgets-->
            @include('blog.layouts.side-widgets')
        </div>
    </div>
@endsection

@section('script')
    <script id="dsq-count-scr" src="//ramonda.disqus.com/count.js" async></script>
    <script>
        (function () { // DON'T EDIT BELOW THIS LINE
            var d = document, s = d.createElement('script');
            s.src = 'https://ramonda.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
@endsection
