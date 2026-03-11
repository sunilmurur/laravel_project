@php
// Breadcrum button Detail
$common['pagetitle']=$data['title'];
$common['btntitle']="Add";
$common['btnurl']= route("Category.create");
$common['breadcrumb1']="Purchase Category";
$common['breadcrumb2']="View Purchase Category";
@endphp
@extends('index',$common)
@section('pagebody')
@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.6/css/dataTables.dataTables.css" />
@endpush 
<div class="pcoded-content">
    <!-- Success Message -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                @include('common.breadcrumb',$common)
                    <div class="page-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- Basic Form Inputs card start -->
                                    <div class="card">
                                        <div class="table-view">
                                        <table id="view_category" class="display cell-border" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Category Name</th>
                                                    <th>Edit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Table body will be populated via AJAX -->
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
</div>


<!-- Basic Form Inputs card end -->
@endsection 
@push('scripts')

<script src="https://cdn.datatables.net/2.0.6/js/dataTables.min.js"></script>
<script type="text/javascript" src="{{ asset('js/custom/data-table/view-purchase-category.min.js') }}"></script>
@endpush 




