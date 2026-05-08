@php
$common['pagetitle'] = 'Edit Role';
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
                                    <h4 class="sub-title mb-0">Edit Role</h4>

                                    <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                                        ← Back
                                    </a>
                                </div>

                                <div class="card-block">

                                    {{-- Errors --}}
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form method="POST" action="{{ route('roles.update', $role->id) }}">
                                        @csrf
                                        @method('PUT')

                                        {{-- Role Name --}}
                                        <div class="form-group">
                                            <label><strong>Role Name</strong></label>
                                            <input type="text" 
                                                   name="name" 
                                                   class="form-control"
                                                   value="{{ old('name', $role->name) }}"
                                                   required>
                                        </div>

                                        {{-- Permissions --}}
                                        <div class="form-group mt-4">
                                            <label><strong>Permissions</strong></label>

                                            {{-- Select All --}}
                                            <div class="form-check mb-2">
                                                <input type="checkbox" id="selectAll" class="form-check-input">
                                                <label class="form-check-label">
                                                    <strong>Select All</strong>
                                                </label>
                                            </div>

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

                                                                <input class="form-check-input permission-checkbox"
                                                                       type="checkbox"
                                                                       name="permissions[]"
                                                                       value="{{ $permission->name }}"
                                                                       id="perm{{ $permission->id }}"
                                                                       {{ in_array($permission->name, old('permissions', $rolePermissions)) ? 'checked' : '' }}>

                                                                <label class="form-check-label" for="perm{{ $permission->id }}">
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
                                                Update Role
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

{{-- Select All --}}
<script>
document.getElementById('selectAll').onclick = function() {
    let checkboxes = document.querySelectorAll('.permission-checkbox');
    checkboxes.forEach(cb => cb.checked = this.checked);
};
</script>

@endsection