@php
$common['pagetitle'] = $data['title'];
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
                                    <h4 class="sub-title mb-0">Roles</h4>
                                  @php  if (Auth::user()->can('role_create')){ @endphp
                                    <a href="{{ route('roles.create') }}" class="btn btn-primary">
                                        + Create Role
                                    </a>
                                @php } @endphp
                                </div>

                                <div class="card-block">

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover">
                                            
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th width="60">SL NO</th>
                                                    <th>Role Name</th>
                                                    <th width="180" class="text-center">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @forelse($roles as $key => $role)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $role->name }}</td>
                                                        <td class="text-center">
                                                      <!--  @php  if (Auth::user()->can('role_edit')){ @endphp -->
                                                            <a href="{{ route('roles.edit', $role->id) }}" 
                                                               class="btn btn-sm btn-warning">
                                                                Edit
                                                            </a>
                                                     <!--   @php } @endphp  -->
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3" class="text-center">
                                                            No roles found
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>

                                        </table>
                                    </div>

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