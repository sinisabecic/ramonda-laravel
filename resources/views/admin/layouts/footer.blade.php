<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="{{ url('/logout') }}">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Core plugin JavaScript-->
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('js/sb-admin.min.js') }}"></script>

@include('sweetalert::alert')

{{-- Za JS oblik koda --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.11.3/af-2.3.7/b-2.1.1/b-colvis-2.1.1/b-html5-2.1.1/b-print-2.1.1/cr-1.5.5/date-1.1.1/fc-4.0.1/fh-3.2.1/kt-2.6.4/r-2.2.9/rg-1.1.4/rr-1.2.8/sc-2.0.5/sb-1.3.0/sp-1.4.0/sl-1.3.4/sr-1.1.0/datatables.min.js"></script>


<script src="{{ asset('js/jquery.mask.js') }}"></script>
{{--<script src="{{ asset('js/functions.js') }}"></script>--}}

<script src="https://unpkg.com/filepond/dist/filepond.js"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('/js/demo/datatables-demo.js') }}"></script>


<script>
    //? Dodavanje korisnika
    $(document).ready(function () {

        // const avatar = document.querySelector('input[id="avatar"]');
        //
        // // Create a FilePond instance
        // const pond = FilePond.create(avatar);
        //
        // FilePond.setOptions({
        //     url: '/users/upload',
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     },
        //
        // });


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

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
            })
            ;
        });
    });


    //? Za brisanje korisnika
    // * Noviji nacin
    function deleteUser(item) {

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
                    url: "/users/" + formData.id,
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
                                title: 'User has been deleted!',
                                // text: '',
                                icon: 'success',
                                toast: true,
                                position: 'top-right',
                                showConfirmButton: false,
                                timer: 2500,

                            })
                            console.log("Izbrisan User ID: " + formData.id);

                            // window.location.reload(true);
                            $(".row-user[data-id=" + formData.id + "] .deleteBtn").text("Deleted").attr("disabled", "disabled");

                        }
                    }
                })
            }
        });
    }


    //? Za restore korisnika
    // * Noviji nacin
    function restoreUser(item) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        Swal.fire({
            title: 'Restore user?',
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
                    url: "/users/" + formData.id + "/restore",
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
                                title: 'User has been restored!',
                                // text: '',
                                icon: 'success',
                                toast: true,
                                position: 'top-right',
                                showConfirmButton: false,
                                timer: 2500,
                            })
                            console.log("Ozivljen User ID: " + formData.id);

                            $(".row-user[data-id=" + formData.id + "] .restoreBtn").text("Restored").attr("disabled", "disabled");
                        }
                    }
                })
            }
        });
    }


    //? Za permanentno brisanje korisnika
    // * Noviji nacin
    function forceDeleteUser(item) {

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
                    url: "/users/" + formData.id + "/remove",
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
                                title: 'User permanently deleted!',
                                // text: '',
                                icon: 'success',
                                toast: true,
                                position: 'top-right',
                                showConfirmButton: false,
                                timer: 2500,

                            })
                            console.log("Permanentno izbrisan User ID: " + formData.id);

                            // window.location.reload(true);
                            $(".row-user[data-id=" + formData.id + "]")
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


</body>

</html>
