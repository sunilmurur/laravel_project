@php
$common['pagetitle'] = 'Create Role';
@endphp

@extends('index', $common)

@section('pagebody')

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">

                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">

                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="sub-title mb-0">Create Role</h4>

                                    <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                                        ← Back
                                    </a>
                                </div>

                                <div class="card-block">

                                    <form method="POST" action="{{ route('roles.store') }}">
                                        @csrf

                                        {{-- Role Name --}}
                                        <div class="form-group">
                                            <label><strong>Role Name</strong></label>
                                            <input type="text" 
                                                   name="name" 
                                                   class="form-control" 
                                                   placeholder="Enter role name" 
                                                   required>
                                        </div>

                                        {{-- Permissions --}}
                                        <div class="form-group mt-4">
                                            <label><strong>Permissions</strong></label>

                                            <div class="row">

                                                @foreach($permissions as $group => $groupPermissions)

                                                    {{-- Group Title --}}
                                                    <div class="col-12 mt-3">
                                                        <h5 class="text-primary text-uppercase">
                                                            {{ ucfirst($group) }}
                                                        </h5>
                                                        <hr>
                                                    </div>

                                                    {{-- Permissions --}}
                                                    @foreach($groupPermissions as $permission)

                                                        <div class="col-md-3 col-sm-6">
                                                            <div class="form-check">

                                                                <input class="form-check-input"
                                                                       type="checkbox"
                                                                       name="permissions[]"
                                                                       value="{{ $permission->name }}"
                                                                       id="perm{{ $permission->id }}">

                                                                <label class="form-check-label"
                                                                       for="perm{{ $permission->id }}">
                                                                    {{ ucwords(str_replace('_', ' ', $permission->name)) }}
                                                                </label>

                                                            </div>
                                                        </div>

                                                    @endforeach

                                                @endforeach

                                            </div>
                                        </div>

                                        {{-- Buttons --}}
                                        <div class="form-group mt-4">
                                            <button type="submit" class="btn btn-success">
                                                Save Role
                                            </button>

                                            <a href="{{ route('roles.index') }}" class="btn btn-danger">
                                                Cancel
                                            </a>
                                        </div>

                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection