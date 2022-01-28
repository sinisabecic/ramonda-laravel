@extends('admin.layouts.app')
@section('style')
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.11.3/af-2.3.7/b-2.1.1/b-colvis-2.1.1/b-html5-2.1.1/b-print-2.1.1/cr-1.5.5/date-1.1.1/fc-4.0.1/fh-3.2.1/kt-2.6.4/r-2.2.9/rg-1.1.4/rr-1.2.8/sc-2.0.5/sb-1.3.0/sp-1.4.0/sl-1.3.4/sr-1.1.0/datatables.min.css"/>
    <link href="{{ asset('css/datatable.css') }}" rel="stylesheet">
@endsection

@section('page-title', 'Categories')


@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"></h6>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-end">
                <a href="#!" class="btn btn-primary btn-sm" data-toggle="modal"
                   data-target="#addCategoryModal"
                   style="float: right">
                    <i class="fas fa-user-plus"></i> New category
                </a>
                <a href="{{ route('blog.categories') }}" class="btn btn-secondary btn-sm ml-1"
                   style="float: right">
                    <i class="fas fa-redo-alt"></i> Refresh
                </a>
            </div>
            <div class="table table-responsive">
                <table class="display hover" id="dataTableCategories" width="100%"
                       cellspacing="0">
                    <thead>
                    <tr>
                        {{--                        <th>--}}
                        {{--                                                        <input type="checkbox" id="selectAllBoxes">--}}
                        {{--                        </th>--}}
                        <th>ID</th>
                        <th>Category</th>
                        <th>Slug</th>
                        <th>Created</th>
                        <th>Created at</th>
                        <th>Deleted at</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($categories as $category)
                        <tr class="row-category" data-id="{{ $category->id }}">
                            {{--                            <td>--}}
                            {{--                                <input type="checkbox" name="user_id[]" id="delete_user" class="checkBoxes"--}}
                            {{--                                       data-id="{{ $user->id }}">--}}
                            {{--                            </td>--}}
                            <td><span class="small">{{ $category->id }}</span></td>
                            <td><span class="small">{{ $category->name }}</span></td>
                            <td>
                                <p class="small"><strong>{{ $category->slug }}</strong></p>
                            </td>
                            <td>
                                 <span class="badge badge-pill badge-secondary small">
                                     {{ $category->created_at->diffForHumans() }}
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-pill small">
                                    {{ $category->created_at->format('d.m.Y. H:i:s') }}
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-pill small deletedAt">
                                     @if($category->deleted_at)
                                        {{ $category->deleted_at->format('d.m.Y. H:i:s') }}
                                    @else
                                        {{ 'NULL' }}
                                    @endif
                                </span>
                            </td>
                            <td>
                                <div class="d-inline-flex">

                                    @if(!$category->deleted_at)
                                        <div class="px-1">
                                            <button type="button" onclick="deleteCategory('{{ $category->id }}')"
                                                    class="btn btn-danger deleteCategoryBtn">
                                                Delete
                                            </button>
                                        </div>
                                    @else
                                        <div class="px-1">
                                            <button type="button" onclick="restoreCategory('{{ $category->id }}')"
                                                    class="btn btn-dark restoreCategoryBtn">
                                                Restore
                                            </button>
                                        </div>
                                    @endif

                                    <div class="px-1">
                                        <button type="button" onclick="forceDeleteCategory('{{ $category->id }}')"
                                                class="btn btn-warning text-dark forceDeleteCategoryBtn">
                                            Remove
                                        </button>
                                    </div>
                                    @if(!$category->deleted_at)
                                        <div class="px-1">
                                            <a href="{{ route("categories.edit", $category->id) }}" id="editcategory"
                                               class="btn btn-primary editCategoryBtn" data-id="{{ $category->id }}">
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

@include('admin.categories.add_category')

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
            $('#addCategoryForm').submit(function (e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    method: 'POST',
                    url: "{{ route('blog.categories.store') }}",
                    data: formData,
                    success: function () {
                        $('#addCategoryModal').modal('hide');
                        clearFields('#addCategoryModal');

                        Swal.fire({
                            title: 'Category added!',
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

        function deleteCategory(item) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            Swal.fire({
                title: 'Delete user?',
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
                        url: "/admin/categories/" + formData.id,
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
                                    title: 'Category has been deleted!',
                                    // text: '',
                                    icon: 'success',
                                    toast: true,
                                    position: 'top-right',
                                    showConfirmButton: false,
                                    timer: 2500,

                                })
                                console.log("Izbrisana rola ID: " + formData.id);

                                // window.location.reload(true);
                                $(".row-category[data-id=" + formData.id + "] .deleteCategoryBtn").text("Deleted").attr("disabled", "disabled");
                                $(".row-category[data-id=" + formData.id + "] .editCategoryBtn").fadeOut('slow');

                                var currentdate = new Date();
                                var timestamp = currentdate.getDate() + "."
                                    + (currentdate.getMonth() + 1) + "."
                                    + currentdate.getFullYear() + ". "
                                    + currentdate.getHours() + ":"
                                    + currentdate.getMinutes() + ":"
                                    + currentdate.getSeconds();

                                $(".row-category[data-id=" + formData.id + "] .deletedAt").text(timestamp);


                            }
                        }
                    })
                }
            });
        }


        function restoreCategory(item) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            Swal.fire({
                title: 'Restore category?',
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
                        url: "/admin/categories/" + formData.id + "/restore",
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
                                    title: 'Category has been restored!',
                                    // text: '',
                                    icon: 'success',
                                    toast: true,
                                    position: 'top-right',
                                    showConfirmButton: false,
                                    timer: 2500,
                                })
                                console.log("Ozivljena rola ID: " + formData.id);

                                $(".row-category[data-id=" + formData.id + "] .restoreCategoryBtn").text("Restored").attr("disabled", "disabled");
                                $(".row-category[data-id=" + formData.id + "] .deletedAt").text("NULL");
                            }
                        }
                    })
                }
            });
        }


        function forceDeleteCategory(item) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            Swal.fire({
                title: 'Delete permanently?',
                text: "You won't be able to restore user!",
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
                        url: "/admin/categories/" + formData.id + "/remove",
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
                                    title: 'Category permanently deleted!',
                                    // text: '',
                                    icon: 'success',
                                    toast: true,
                                    position: 'top-right',
                                    showConfirmButton: false,
                                    timer: 2500,

                                })
                                console.log("Permanentno izbrisan Category ID: " + formData.id);

                                // window.location.reload(true);
                                $(".row-category[data-id=" + formData.id + "]")
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


        function clearFields(form) {
            $(':input', form)
                .not(':button, :submit, :reset, :hidden')
                .val('')
                .prop('checked', false)
                .prop('selected', false);
        }
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
            src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.11.3/af-2.3.7/b-2.1.1/b-colvis-2.1.1/b-html5-2.1.1/b-print-2.1.1/cr-1.5.5/date-1.1.1/fc-4.0.1/fh-3.2.1/kt-2.6.4/r-2.2.9/rg-1.1.4/rr-1.2.8/sc-2.0.5/sb-1.3.0/sp-1.4.0/sl-1.3.4/sr-1.1.0/datatables.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="{{ asset('/js/demo/datatables-demo.js') }}"></script>
@endsection



