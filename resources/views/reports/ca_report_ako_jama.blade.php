@php
// Breadcrum button Detail
$common['pagetitle']=$data['title'];
$common['btntitle']="Add";
$common['btnurl']= route("Category.create");
$common['breadcrumb1']="AKO";
$common['breadcrumb2']="AKO Jama Report";
@endphp
@extends('index',$common)
@section('pagebody')
@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.6/css/dataTables.dataTables.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.5/css/buttons.dataTables.min.css">
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
                          <!-- BreadCrum Starts --> 
            <div class="card">
                <div class="card-block">
                    <div class="breadcrumb-header">
                        <h5>{{$data['title']}}</h5>
                        <hr>
                    </div>
                    <div class="row text-center">
                        @php
                        $res_todays_date = gettodaydate(); 
                        $res_years = get_years();
                        @endphp
                    <div class="col-sm-2">
                    <label for="financial_year" class="form-label"><b>Financial Year</b></label>
                        <select name="financial_year" class="form-control financial_year">
                                @foreach($res_years as $id => $display_year)
                                    <option value="{{ $id }}">{{ $display_year }}</option>
                                @endforeach
                            </select>
                    </div>
                   
                    <div class="col-sm-2 mt-4">
                        <button type="button" class="btn btn-primary waves-effect waves-light submit_purchase_report">Submit</button>
                    </div>
                </div>
                    
                </div>
            </div> 
            <!-- BreadCrum Ends -->
                    <div class="page-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- Basic Form Inputs card start -->
                                    <div class="card">
                                        <div class="table-view">
                                        <table id="ca-report-ako-jama" class="display cell-border" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>SL NO</th>
                                                    <th>Jama </th>
                                                    <th>Akki</th>
                                                    <th>Kai</th>
                                                    <th>Oil</th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                                <!-- Table body will be populated via AJAX -->
                                            </tbody>
                                            <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>Grand Total</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
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



<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.5/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.pdf.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>


<script type="text/javascript" src="{{ asset('js/custom/data-table/ca-ako-jama-report.min.js') }}"></script>
@endpush 




