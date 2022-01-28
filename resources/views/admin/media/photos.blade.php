@extends('admin.layouts.app')
@section('style')
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.11.3/af-2.3.7/b-2.1.1/b-colvis-2.1.1/b-html5-2.1.1/b-print-2.1.1/cr-1.5.5/date-1.1.1/fc-4.0.1/fh-3.2.1/kt-2.6.4/r-2.2.9/rg-1.1.4/rr-1.2.8/sc-2.0.5/sb-1.3.0/sp-1.4.0/sl-1.3.4/sr-1.1.0/datatables.min.css"/>
    <link href="{{ asset('css/datatable.css') }}" rel="stylesheet">
@endsection

@section('page-title', 'Media')


@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"></h6>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-end">
                <a href="{{ route('media.photos') }}" class="btn btn-secondary btn-sm ml-1"
                   style="float: right">
                    <i class="fas fa-redo-alt"></i> Refresh
                </a>
            </div>
            <div class="table table-responsive">
                <table class="display hover" id="dataPhotosTable" width="100%"
                       cellspacing="0">
                    <thead>
                    <tr>
                        {{--                        <th>--}}
                        {{--                                                        <input type="checkbox" id="selectAllBoxes">--}}
                        {{--                        </th>--}}
                        <th>ID</th>
                        <th>Image</th>
                        <th>Owner</th>
                        <th>Type</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($photos as $photo)
                        <tr class="row-user" data-id="{{ $photo->id }}">
                            {{--                            <td>--}}
                            {{--                                <input type="checkbox" name="user_id[]" id="delete_user" class="checkBoxes"--}}
                            {{--                                       data-id="{{ $user->id }}">--}}
                            {{--                            </td>--}}
                            <td><span class="small">{{ $photo->id }}</span></td>
                            <td>
                                <img
                                    @if($user->avatar !== 'user.jpg')
                                    src="{{env('AVATAR') .'/'. $user->id .'/'. $user->avatar}}"
                                    @else
                                    src="/uploads/{{ 'user.jpg' }}"
                                    @endif
                                    alt=""
                                    height="43px"
                                    width="43px">
                            </td>
                            <td><span class="small">{{ $user->name }}</span></td>
                            <td class="role">
                                @foreach($user->roles as $role)
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item m-0 p-0 py-1 bg-transparent">
                                            @switch($role->name)
                                                @case(ucfirst("admin"))
                                                <span
                                                    class="badge badge-pill badge-dark rounded-0">{{ $role->name }}</span>
                                                @break
                                                @case(ucfirst("user"))
                                                <span
                                                    class="badge badge-pill badge-success rounded-0">{{ $role->name }}</span>
                                                @break
                                                @case(ucfirst("subscriber"))
                                                <span
                                                    class="badge badge-pill badge-warning text-dark rounded-0">{{ $role->name }}</span>
                                                @break
                                                @case(ucfirst("partner"))
                                                <span
                                                    class="badge badge-pill badge-info rounded-0">{{ $role->name }}</span>
                                                @break
                                                @case(ucfirst("author"))
                                                <span
                                                    class="badge badge-pill badge-primary rounded-0">{{ $role->name }}</span>
                                                @break
                                                @case(ucfirst("nomad"))
                                                <span
                                                    class="badge badge-pill badge-danger rounded-0">{{ $role->name }}</span>
                                                @break
                                                @default(ucfirst("nomad"))
                                                <span
                                                    class="badge badge-pill badge-danger rounded-0">{{ $role->name }}</span>
                                            @endswitch
                                        </li>
                                    </ul>
                                @endforeach
                            </td>
                            <td>
                                @switch($user->is_active)
                                    @case("1")
                                    <span
                                        class="badge badge-pill badge-success rounded">{{ __('Active') }}</span>
                                    @break
                                    @case("0")
                                    <span
                                        class="badge badge-pill badge-danger rounded">{{ __('Not Active') }}</span>
                                    @break
                                    @default("0")
                                @endswitch
                            </td>
                            <td class="small font-weight-bold">
                                <a href="mailto:{{ $user->email }}" class="text-dark">{{ $user->email }}</a>
                            </td>
                            <td class="country small">{{ $user->country->name }}</td>
                            <td>
                                 <span class="badge badge-pill badge-secondary small">
                                     {{ $user->created_at->diffForHumans() }}
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-pill small">
                                    {{ $user->created_at->format('d.m.Y. H:i:s') }}
                                </span>
                            </td>
                            <td>
                                <div class="d-inline-flex">

                                    @if(!$user->deleted_at)
                                        <div class="px-1">
                                            <button type="button" onclick="deleteUser('{{ $user->id }}')"
                                                    class="btn btn-danger deleteBtn">
                                                Delete
                                            </button>
                                        </div>
                                    @else
                                        @if(auth()->user()->is_admin)
                                            <div class="px-1">
                                                <button type="button" onclick="restoreUser('{{ $user->id }}')"
                                                        class="btn btn-dark restoreBtn">
                                                    Restore
                                                </button>
                                            </div>
                                        @endif
                                    @endif

                                    @if(auth()->user()->is_admin)
                                        <div class="px-1">
                                            <button type="button" onclick="forceDeleteUser('{{ $user->id }}')"
                                                    class="btn btn-warning text-dark forceDeleteBtn">
                                                Remove
                                            </button>
                                        </div>
                                    @endif
                                    @if(!$user->deleted_at)

                                        <div class="btn-group editUserBtn">
                                            <button type="button" class="btn btn-primary dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Edit
                                            </button>
                                            <div class="dropdown-menu">
                                                <a href="{{ route("users.edit", $user->id) }}" id="edituser"
                                                   class="dropdown-item" data-id="{{ $user->id }}">
                                                    Edit data
                                                </a>
                                                <a href="{{ route("users.edit.password", $user->id) }}"
                                                   id="editpassword"
                                                   class="dropdown-item"
                                                   data-id="{{ $user->id }}">
                                                    Edit password
                                                </a>
                                            </div>
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

