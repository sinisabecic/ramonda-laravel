<section class="mb-5">
    <div class="card bg-light">
        <div class="card-body">
            <!-- Comment form-->
            <form method="POST" action="{{ route('post.comment.store', $post->id) }}" id="addCommentForm" class="mb-4">
                @method('POST')
                @csrf
                <textarea name="comment" class="form-control" rows="3"
                          placeholder="Join the discussion and leave a comment!"></textarea>

                <div class="mt-2 mb-4 float-left">
                    <input type="submit" class="btn btn-primary" value="Post comment">
                </div>
            </form>

            <hr/>
            <!-- Comment with nested comments-->
            @foreach($post->comments as $comment)
                @if($comment->is_aproved == 1)
                    <div class="d-flex mb-4" id="{{ $comment->id }}">
                        <!-- Parent comment-->
                        <div class="flex-shrink-0"><img class="rounded-circle" width="50" height="50"
                                                        @if(auth()->user())
                                                        @foreach (auth()->user()->photos as $img)
                                                        @if($img->url !== 'user.jpg')
                                                        src="{{env('AVATAR') .'/'. $img->imageable_id .'/'. $img->url }}"
                                                        @else
                                                        src="/uploads/{{ 'user.jpg' }}"
                                                        @endif
                                                        @endforeach
                                                        @else
                                                        src="/uploads/{{ 'user.jpg' }}"
                                                        @endif
                                                        alt="..."/></div>
                        <div class="ms-3">
                            <div class="fw-bold">{{ $comment->author->username ?? 'Anonymous' }}</div>
                            {{ $comment->comment  }}
                        </div>
                    </div>
                @endif
            @endforeach

        <!-- Single comment-->
            {{--            --}}
            {{--                <div class="d-flex">--}}
            {{--                    <div class="flex-shrink-0"><img class="rounded-circle"--}}
            {{--                                                    src="https://dummyimage.com/50x50/ced4da/6c757d.jpg"--}}
            {{--                                                    alt="..."/></div>--}}
            {{--                    <div class="ms-3">--}}
            {{--                        <div class="fw-bold">{{ $comment->author ?: 'anonymos' }}</div>--}}
            {{--                        When I look at the universe and all the ways the universe wants to kill us, I find--}}
            {{--                        it hard to reconcile that with statements of beneficence.--}}
            {{--                    </div>--}}
            {{--                </div>--}}

        </div>
    </div>
</section>

@section('script')
    <script>
        //? Dodavanje korisnika
        {{--$(document).ready(function () {--}}

        {{--    $.ajaxSetup({--}}
        {{--        headers: {--}}
        {{--            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
        {{--        }--}}
        {{--    });--}}

        {{--    $('#addCommentForm').submit(function (e) {--}}
        {{--        e.preventDefault();--}}

        {{--        var formData = new FormData(this);--}}

        {{--        $.ajax({--}}
        {{--            method: 'POST',--}}
        {{--            url: "{{ route('post.comment.store', $post->id) }}",--}}
        {{--            data: formData,--}}
        {{--            success: function () {--}}
        {{--                // clearFields('#addCommentForm');--}}
        {{--                Swal.fire({--}}
        {{--                    title: 'Comment sent!',--}}
        {{--                    text: 'Comment will be approved soon',--}}
        {{--                    icon: 'success',--}}
        {{--                    toast: true,--}}
        {{--                    position: 'top-right',--}}
        {{--                    showConfirmButton: false,--}}
        {{--                    timer: 2500,--}}
        {{--                });--}}
        {{--            },--}}
        {{--            error: function () {--}}
        {{--                // alert('Greska! Pokusaj ponovo');--}}
        {{--                Swal.fire({--}}
        {{--                    title: 'Error! Something went wrong',--}}
        {{--                    // text: '',--}}
        {{--                    icon: 'error',--}}
        {{--                    toast: true,--}}
        {{--                    position: 'top-right',--}}
        {{--                    showConfirmButton: false,--}}
        {{--                    timer: 2500,--}}
        {{--                })--}}
        {{--            },--}}
        {{--            contentType: false,--}}
        {{--            processData: false,--}}
        {{--        });--}}
        {{--    });--}}
        {{--});--}}

        function clearFields(form) {
            $(':input', form)
                .not(':button, :submit, :reset, :hidden')
                .val('')
                .prop('checked', false)
                .prop('selected', false);
        }
    </script>
@endsection
