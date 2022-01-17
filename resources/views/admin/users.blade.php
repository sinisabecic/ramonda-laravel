@extends('admin.layouts.app')


@section('page-title', 'Users')


@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"></h6>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-end">
                <a href="#!" class="btn btn-primary btn-sm" data-toggle="modal"
                   data-target="#addModal"
                   style="float: right">
                    <i class="fas fa-user-plus"></i> New user
                </a>
                <a href="{{ route('users') }}" class="btn btn-secondary btn-sm ml-1"
                   style="float: right">
                    <i class="fas fa-redo-alt"></i> Refresh
                </a>
            </div>
            <div class="table table-responsive">
                <table class="display hover" id="dataTable" width="100%"
                       cellspacing="0">
                    <thead>
                    <tr>
                        {{--                        <th>--}}
                        {{--                                                        <input type="checkbox" id="selectAllBoxes">--}}
                        {{--                        </th>--}}
                        <th>ID</th>
                        <th>Username</th>
                        <th>Avatar</th>
                        <th>Name</th>
                        <th>Role(s)</th>
                        <th>E-mail</th>
                        <th>Country</th>
                        <th>Registered</th>
                        <th>Created at</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($users as $user)
                        <tr class="row-user" data-id="{{ $user->id }}">
                            {{--                            <td>--}}
                            {{--                                <input type="checkbox" name="user_id[]" id="delete_user" class="checkBoxes"--}}
                            {{--                                       data-id="{{ $user->id }}">--}}
                            {{--                            </td>--}}
                            <td>{{ $user->id }}</td>
                            <td>
                                <p><strong>{{ $user->username }}</strong></p>
                            </td>
                            <td>
                                <img
                                    src="/uploads/{{ $user->photo->path ?? 'user.jpg' }}"
                                    alt=""
                                    height="43px"
                                    width="43px">
                            </td>
                            <td>{{ $user->name }}</td>
                            <td class="role">
                                @foreach($user->roles as $role)
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item m-0 p-0 py-1 bg-transparent">
                                            @switch($role->name)
                                                @case("administrator")
                                                <span
                                                    class="badge badge-pill badge-dark rounded-0">{{ $role->name }}</span>
                                                @break
                                                @case("guest")
                                                <span
                                                    class="badge badge-pill badge-success rounded-0">{{ $role->name }}</span>
                                                @break
                                                @case("subscriber")
                                                <span
                                                    class="badge badge-pill badge-warning text-dark rounded-0">{{ $role->name }}</span>
                                                @break
                                                @case("partner")
                                                <span
                                                    class="badge badge-pill badge-info rounded-0">{{ $role->name }}</span>
                                                @break
                                                @case("head")
                                                <span
                                                    class="badge badge-pill badge-primary rounded-0">{{ $role->name }}</span>
                                                @break
                                                @case("nomad")
                                                <span
                                                    class="badge badge-pill badge-danger rounded-0">{{ $role->name }}</span>
                                                @break
                                                @default("nomad")
                                                <span
                                                    class="badge badge-pill badge-danger rounded-0">{{ $role->name }}</span>
                                            @endswitch
                                        </li>
                                    </ul>
                                @endforeach
                            </td>
                            <td class="email">
                                {{ $user->email }}
                            </td>
                            <td class="country">{{ $user->country->name }}</td>
                            <td>
                                 <span class="badge badge-pill badge-secondary">
                                     {{ $user->created_at->diffForHumans() }}
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-pill badge-link">
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
                                        <div class="px-1">
                                            <button type="button" onclick="restoreUser('{{ $user->id }}')"
                                                    class="btn btn-dark restoreBtn">
                                                Restore
                                            </button>
                                        </div>
                                    @endif

                                    <div class="px-1">
                                        <button type="button" onclick="forceDeleteUser('{{ $user->id }}')"
                                                class="btn btn-warning text-dark forceDeleteBtn">
                                            Remove
                                        </button>
                                    </div>

                                    <div class="px-1">
                                        <a href="{{ route("users.edit", $user->id) }}" id="edituser"
                                           class="btn btn-primary editUserBtn" data-id="{{ $user->id }}">
                                            Edit
                                        </a>
                                    </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@include('admin.layouts.add_user')



