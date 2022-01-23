@extends('admin.layouts.app')

@section('page-title', 'User profile: ' . ucfirst($user->name))

@section('content')

    <div class="row">
        <div class="col-sm-6">
            <form method="POST" action="" enctype="multipart/form-data" id="editProfileForm">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                               name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>


                <div class="form-group row">
                    <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                    <div class="col-md-6">
                        <input id="username" type="text"
                               class="form-control @error('username') is-invalid @enderror" name="username"
                               value="{{ $user->username }}" autocomplete="username" autofocus>

                        @error('username')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ $user->email }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>


                <div class="form-group row">
                    <label for="password-confirm"
                           class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control"
                               name="password_confirmation" autocomplete="new-password" value="{{ $user->password }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('Country')
                                        }}</label>

                    <div class="col-md-6">
                        <select class="form-control" name="country_id" id="country">

                            <option value="{{ $user->country->id }}" selected>{{ $user->country->name }}</option>

                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address')
                                        }}</label>

                    <div class="col-md-6">
                        <input id="address" type="text"
                               class="form-control @error('address') is-invalid @enderror" name="address"
                               value="{{ $user->address }}" autocomplete="address" autofocus>

                        @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                @if(auth()->user()->hasRole('admin'))
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                        <div class="col-md-6">
                            <select class="form-control" name="role" id="role">
                                @foreach ($user->roles as $role)
                                    <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                                @endforeach

                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif

                <div>
                    <label for="avatar"
                           class="col-md-4 col-form-label text-md-right">{{ __('Profil image') }}</label>
                    <div class="col-md-6" style="left: 12.6rem!important;top: -1.7rem!important;">
                        <input type="file" id="avatar"
                               class="form-control-file @error('avatar') is-invalid @enderror"
                               name="avatar" value="{{ $user->avatar }}">

                        @error('avatar')
                        <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Save') }}
                        </button>
                        <a href="{{ route('users') }}" type="button" class="btn btn-secondary">
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>


        <div class="col-sm-6">
            <div class="d-flex justify-content-center">
                <img
                    @if($user->avatar !== 'user.jpg')
                    src="{{env('AVATAR') .'/'. $user->id .'/'. $user->avatar}}"
                    @else
                    src="/uploads/{{ 'user.jpg' }}"
                    @endif
                    alt=""
                    height="50%"
                    width="50%"
                    class="rounded">
            </div>
        </div>
    </div>

@endsection


@section('script')
    <script>
        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //? Za izmjenu korisnika
            $('#editProfileForm').submit(function (e) {
                e.preventDefault();
                const formData = new FormData(this);
                $.ajax({
                    url: "/admin/users/" + {{ $user->id }}, // Bitno je da isti url bude za sve kako bi prosao, da se ne pravi if elle uslov
                    method: 'POST',
                    data: formData,
                    success: function () {
                        Swal.fire({
                            title: 'Profile edited!',
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
    </script>
@endsection
