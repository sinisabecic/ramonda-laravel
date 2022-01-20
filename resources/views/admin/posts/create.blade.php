@extends('admin.layouts.app')
@section('page-title', 'New post')

@section('content')

    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data" id="addPostForm">
        @csrf
        @method('POST')
                <div class="form-group row">
                    <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                    <div class="col-md-6">
                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                               name="title" required autocomplete="name" autofocus>

                        @error('title')
                        <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="editor" class="col-md-4 col-form-label text-md-right">{{ __('Content') }}</label>

                    <div class="col-md-6">
                        <textarea id="editor" cols="80" rows="10"
                               class="form-control @error('content') is-invalid @enderror" name="content"></textarea>

                        @error('content')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="user_id" class="col-md-4 col-form-label text-md-right">{{ __('Author') }}</label>

                    <div class="col-md-6">
                        <select class="form-control" name="user_id" id="user_id">

                            <option value="{{ auth()->user()->id }}" selected>{{ auth()->user()->name }}</option>

                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

        <div>
            <label for="banner" class="col-md-4 col-form-label text-md-right">{{ __('Banner') }}</label>
            <div class="col-md-6" style="left: 25.8rem!important;top: -1.7rem!important;">
                <input type="file" id="banner"
                       class="form-control-file @error('banner') is-invalid @enderror"
                       name="banner" value="{{ old('banner') }}">

                @error('banner')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Create') }}
                </button>
                <a href="{{ route('posts.index') }}" type="button" class="btn btn-secondary">
                    {{ __('Cancel') }}
                </a>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>

        //? Dodavanje korisnika
        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //? Za dodavanje korisnika
            $('#addPostForm').submit(function (e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    method: 'POST',
                    url: "{{ route('posts.store') }}",
                    data: formData,
                    success: function () {
                        clearFields('#addPostForm');
                        Swal.fire({
                            title: 'Post created!',
                            // text: '',
                            icon: 'success',
                            toast: true,
                            position: 'top-right',
                            showConfirmButton: false,
                            timer: 2500,
                        });
                    },
                    error: function () {
                        // alert('Greska! Pokusaj ponovo');
                        Swal.fire({
                            title: 'Error! Something went wrong',
                            // text: '',
                            icon: 'error',
                            toast: true,
                            position: 'top-right',
                            showConfirmButton: false,
                            timer: 2500,
                        })
                    },
                    contentType: false,
                    processData: false,
                });
            });
        });

        function clearFields(form) {
            $(':input', form)
                .not(':button, :submit, :reset, :hidden')
                .val('')
                .prop('checked', false)
                .prop('selected', false);

        }

    //? Editor
        tinymce.init({
            selector: 'textarea#editor',
            skin: 'bootstrap',
            plugins: 'lists, link, image, media',
            toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help',
            menubar: true,
            setup: (editor) => {
                // Apply the focus effect
                editor.on("init", () => {
                    editor.getContainer().style.transition =
                        "border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out";
                });
                editor.on("focus", () => {
                    (editor.getContainer().style.boxShadow =
                        "0 0 0 .2rem rgba(0, 123, 255, .25)"),
                        (editor.getContainer().style.borderColor = "#80bdff");
                });
                editor.on("blur", () => {
                    (editor.getContainer().style.boxShadow = ""),
                        (editor.getContainer().style.borderColor = "");
                });
            },
        });

    </script>
@endsection
