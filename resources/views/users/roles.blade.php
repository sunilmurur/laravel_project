@php
$common['pagetitle'] = 'User Role Management';
@endphp

@extends('index', $common)

@section('pagebody')

<div class="pcoded-content">
    <div class="pcoded-inner-content">

        <div class="main-body">
            <div class="page-wrapper">

                <div class="page-body">

                    <div class="card">

                        <div class="card-header">
                            <h4>User Role Management</h4>
                        </div>

                        <div class="card-block">

                            {{-- Success Message --}}
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            {{-- Error Message --}}
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <table class="table table-bordered table-striped">

                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Current Role</th>
                                        <th>Change Role</th>
                                        <th>Change Password</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach($users as $user)

                                        <tr>

                                            {{-- ID --}}
                                            <td>
                                                {{ $user->id }}
                                            </td>

                                            {{-- Name --}}
                                            <td>
                                                {{ $user->name }}
                                            </td>

                                            {{-- Email --}}
                                            <td>
                                                {{ $user->email }}
                                            </td>

                                            {{-- Current Role --}}
                                            <td>
                                                {{ $user->getRoleNames()->first() }}
                                            </td>

                                            {{-- Change Role --}}
                                            <td>

                                                <form method="POST"
                                                      action="{{ route('users.roles.update', $user->id) }}">

                                                    @csrf

                                                    <div class="d-flex">

                                                        <select name="role"
                                                                class="form-control">

                                                            @foreach($roles as $role)

                                                                <option value="{{ $role->name }}"
                                                                    {{ $user->hasRole($role->name) ? 'selected' : '' }}>

                                                                    {{ ucfirst($role->name) }}

                                                                </option>

                                                            @endforeach

                                                        </select>
                                                    @php  if (Auth::user()->can('permission_edit')){ @endphp
                                                        <button type="submit"
                                                                class="btn btn-primary ml-2">

                                                            Update

                                                        </button>
                                                    @php } @endphp
                                                    </div>

                                                </form>

                                            </td>

                                            {{-- Change Password --}}
                                            <td>
                                            @php  if (Auth::user()->can('permission_changepassword')){ @endphp
                                                <button class="btn btn-warning btn-sm"
                                                        data-toggle="modal"
                                                        data-target="#passwordModal{{ $user->id }}">

                                                    Change Password

                                                </button>
                                            @php } @endphp
                                            </td>

                                        </tr>

                                        {{-- Password Modal --}}
                                        <div class="modal fade"
                                             id="passwordModal{{ $user->id }}"
                                             tabindex="-1"
                                             role="dialog">

                                            <div class="modal-dialog" role="document">

                                                <div class="modal-content">

                                                    <form method="POST"
                                                          action="{{ route('users.password.update', $user->id) }}">

                                                        @csrf

                                                        <div class="modal-header">

                                                            <h5 class="modal-title">
                                                                Change Password - {{ $user->name }}
                                                            </h5>

                                                            <button type="button"
                                                                    class="close"
                                                                    data-dismiss="modal">

                                                                <span>&times;</span>

                                                            </button>

                                                        </div>

                                                        <div class="modal-body">

                                                            {{-- Password --}}
                                                            <div class="form-group">

                                                                <label>
                                                                    New Password
                                                                </label>

                                                                <input type="password"
                                                                       name="password"
                                                                       class="form-control"
                                                                       autocomplete="new-password"
                                                                       required>

                                                            </div>

                                                            {{-- Confirm Password --}}
                                                            <div class="form-group">

                                                                <label>
                                                                    Confirm Password
                                                                </label>

                                                                <input type="password"
                                                                       name="password_confirmation"
                                                                       class="form-control"
                                                                       autocomplete="new-password"
                                                                       required>

                                                            </div>

                                                        </div>

                                                        <div class="modal-footer">

                                                            <button type="submit"
                                                                    class="btn btn-primary">

                                                                Update Password

                                                            </button>

                                                            <button type="button"
                                                                    class="btn btn-secondary"
                                                                    data-dismiss="modal">

                                                                Close

                                                            </button>

                                                        </div>

                                                    </form>

                                                </div>

                                            </div>

                                        </div>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>
</div>

@endsection