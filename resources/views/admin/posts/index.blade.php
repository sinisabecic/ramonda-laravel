@extends('admin.layouts.app')


@section('page-title', 'Posts')


@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"></h6>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-end">
                <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm"
                   style="float: right">
                    <i class="fas fa-user-plus"></i> New post
                </a>
                <a href="{{ route('posts.index') }}" class="btn btn-secondary btn-sm ml-1"
                   style="float: right">
                    <i class="fas fa-redo-alt"></i> Refresh
                </a>
            </div>
            <div class="table table-responsive">
                <table class="display hover" id="dataTablePosts" width="100%"
                       cellspacing="0">
                    <thead>
                    <tr>
                        {{--                        <th>--}}
                        {{--                                                        <input type="checkbox" id="selectAllBoxes">--}}
                        {{--                        </th>--}}
                        <th>ID</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Banner</th>
                        <th>Created</th>
                        <th>Created at</th>
                        <th>Author</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($posts as $post)
                        <tr class="row-post" data-id="{{ $post->id }}">
                            {{--                            <td>--}}
                            {{--                                <input type="checkbox" name="user_id[]" id="delete_user" class="checkBoxes"--}}
                            {{--                                       data-id="{{ $user->id }}">--}}
                            {{--                            </td>--}}
                            <td><span class="small">{{ $post->id }}</span></td>
                            <td>
                                <p class="small"><strong>{{ substr($post->title, 0, 90) }}</strong></p>
                            </td>

                            <td>
                                <p class="small">{{ substr($post->content, 0, 90) }}</p>
                            </td>
                            <td>
                                <img
                                    @if($post->banner)
                                        src="{{env('BANNER') .'/'. $post->banner}}"
                                    @else
                                        src="{{ env('APP_URL') }}/storage/uploads/WIN_20211223_17_10_40_Pro.jpg"
                                    @endif
                                    alt=""
                                    height="43px"
                                    width="43px">
                            </td>
{{--                            <td>--}}
{{--                                <img--}}
{{--                                    @if($user->avatar)--}}
{{--                                    src="{{env('AVATAR') .'/'. $post->id .'/'. $user->avatar}}"--}}
{{--                                    @else--}}
{{--                                    src="uploads/{{ 'user.jpg' }}"--}}
{{--                                    @endif--}}
{{--                                    alt=""--}}
{{--                                    height="43px"--}}
{{--                                    width="43px">--}}
{{--                            </td>--}}

                            <td>
                                 <span class="badge badge-pill badge-secondary small">
                                     {{ $post->created_at->diffForHumans() }}
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-pill small">
                                    {{ $post->created_at->format('d.m.Y. H:i:s') }}
                                </span>
                            </td>

                            <td>
                                <p class="small font-weight-bold">{{ $post->author->username }}</p>
                            </td>

                            <td>
                                <div class="d-inline-flex">

                                    @if(!$post->deleted_at)
                                        <div class="px-1">
                                            <button type="button" onclick="deletePost('{{ $post->id }}')"
                                                    class="btn btn-danger deletePostBtn">
                                                Delete
                                            </button>
                                        </div>
                                    @else
                                        <div class="px-1">
                                            <button type="button" onclick="restorePost('{{ $post->id }}')"
                                                    class="btn btn-dark restorePostBtn">
                                                Restore
                                            </button>
                                        </div>
                                    @endif

                                    <div class="px-1">
                                        <button type="button" onclick="forceDeletePost('{{ $post->id }}')"
                                                class="btn btn-warning text-dark forceDeletePostBtn">
                                            Remove
                                        </button>
                                    </div>
                                @if(!$post->deleted_at)
                                    <div class="px-1">
                                        <a href="{{ route("posts.edit", $post->id) }}" id="editpost"
                                           class="btn btn-primary editPostBtn" data-id="{{ $post->id }}">
                                            Edit
                                        </a>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

{{--@include('admin.layouts.add_user')--}}


@section('script')
    <script>
        //? Dodavanje korisnika
        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //? Za dodavanje korisnika
            $('#addUserForm').submit(function (e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    url: "{{ route('register') }}",
                    method: 'POST',
                    data: formData,
                    success: function () {
                        $('#addModal').modal('hide');
                        clearFields('#addModal');

                        Swal.fire({
                            title: 'User added!',
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


            //? Za izmjenu korisnika
            $('#editUserForm').submit(function (e) {
                e.preventDefault();
                const formData = new FormData(this);
                $.ajax({
                    url: "/posts/" + {{ $post->id }},
                    method: 'POST',
                    data: formData,
                    success: function () {
                        Swal.fire({
                            title: 'Post edited!',
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
                })
                ;
            });

        });


        //? Za brisanje korisnika
        // * Noviji nacin
        function deletePost(item) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            Swal.fire({
                title: 'Delete post?',
                // text: "You won't be able to revert this!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3C4B64',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
                toast: true,
                position: 'top-right',

            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = {id: item};
                    $.ajax({
                        type: "DELETE",
                        url: "/posts/" + formData.id,
                        data: formData,
                        success: function (response) {
                            if (response.error) {
                                console.log(response.error);
                                Swal.fire({
                                    title: 'Error! Try again.',
                                    // text: '',
                                    icon: 'warning',
                                    toast: true,
                                    position: 'top-right',
                                    showConfirmButton: false,
                                    timer: 2500,
                                })
                            } else {
                                Swal.fire({
                                    title: 'Post has been deleted!',
                                    // text: '',
                                    icon: 'success',
                                    toast: true,
                                    position: 'top-right',
                                    showConfirmButton: false,
                                    timer: 2500,

                                })
                                console.log("Izbrisan Post ID: " + formData.id);

                                // window.location.reload(true);
                                $(".row-post[data-id=" + formData.id + "] .deletePostBtn").text("Deleted").attr("disabled", "disabled");
                                $(".row-post[data-id=" + formData.id + "] .editPostBtn").fadeOut('slow');


                            }
                        }
                    })
                }
            });
        }


        //? Za restore posta
        // * Noviji nacin
        function restorePost(item) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            Swal.fire({
                title: 'Restore post?',
                // text: "You won't be able to revert this!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3C4B64',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
                toast: true,
                position: 'top-right',

            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = {id: item};
                    $.ajax({
                        type: "PUT",
                        url: "/posts/" + formData.id + "/restore",
                        data: formData,
                        success: function (response) {
                            if (response.error) {
                                console.log(response.error);
                                Swal.fire({
                                    title: 'Error! Try again.',
                                    // text: '',
                                    icon: 'error',
                                    toast: true,
                                    position: 'top-right',
                                    showConfirmButton: false,
                                    timer: 2500,
                                })
                            } else {
                                Swal.fire({
                                    title: 'Post has been restored!',
                                    // text: '',
                                    icon: 'success',
                                    toast: true,
                                    position: 'top-right',
                                    showConfirmButton: false,
                                    timer: 2500,
                                })
                                console.log("Ozivljen Post ID: " + formData.id);

                                $(".row-post[data-id=" + formData.id + "] .restorePostBtn").text("Restored").attr("disabled", "disabled");
                            }
                        }
                    })
                }
            });
        }


        //? Za permanentno brisanje korisnika
        // * Noviji nacin
        function forceDeletePost(item) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            Swal.fire({
                title: 'Delete permanently?',
                text: "You won't be able to restore post!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3C4B64',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
                toast: true,
                position: 'top-right',

            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = {id: item};
                    $.ajax({
                        type: "DELETE",
                        url: "/posts/" + formData.id + "/remove",
                        data: formData,
                        success: function (response) {
                            if (response.error) {
                                console.log(response.error);
                                Swal.fire({
                                    title: 'Error! Try again.',
                                    // text: '',
                                    icon: 'warning',
                                    toast: true,
                                    position: 'top-right',
                                    showConfirmButton: false,
                                    timer: 2500,
                                })
                            } else {
                                Swal.fire({
                                    title: 'Post permanently deleted!',
                                    // text: '',
                                    icon: 'success',
                                    toast: true,
                                    position: 'top-right',
                                    showConfirmButton: false,
                                    timer: 2500,

                                })
                                console.log("Permanentno izbrisan Post ID: " + formData.id);

                                // window.location.reload(true);
                                $(".row-post[data-id=" + formData.id + "]")
                                    .children('td, th')
                                    .animate({
                                        padding: 0
                                    })
                                    .wrapInner('<div />')
                                    .children()
                                    .slideUp(function () {
                                        $(this).closest('tr').remove();
                                    });
                                // .toggleClass("btn-danger")
                                // .toggleClass("btn-dark")
                            }
                        }
                    })
                }
            });
        }


        //* Edit user in modal form
        // $(document).on("click", "#edituser", function () {
        //     $("#editModalLabel").html("Edit user data");
        //     // $(".modal-body form").attr("action", "http://localhost/ramonda/users/update");
        //
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });
        //
        //     const id = $(this).data("id");
        //
        //     $.ajax({
        //         method: "POST",
        //         url: "/users/edit",
        //         data: {user_id: id},
        //         dataType: "JSON",
        //         success: function (data) {
        //             if (data.error) {
        //                 console.log(data.error);
        //                 alert(data.error);
        //             } else {
        //                 console.log(data[0]);
        //
        //                 $("#id").val(data[0].id);
        //                 $("#name").val(data[0].name);
        //                 $("#username").val(data[0].username);
        //                 $("#email").val(data[0].email);
        //                 // $("#password").val(data[0].password);
        //                 $("#address").val(data[0].address);
        //                 $("#city").val(data[0].city);
        //                 $("#country").val(data[0].country);
        //                 $("#phone").val(data[0].phone);
        //                 $("#zip").val(data[0].zip);
        //                 $("#is_admin").val(data[0].is_admin);
        //             }
        //         },
        //         error: function (error) {
        //             console.log(error);
        //             alert("Greška, učitajte ponovo");
        //         },
        //         async: false,
        //     });
        // });


        function clearFields(form) {
            $(':input', form)
                .not(':button, :submit, :reset, :hidden')
                .val('')
                .prop('checked', false)
                .prop('selected', false);
        }
    </script>
@endsection

