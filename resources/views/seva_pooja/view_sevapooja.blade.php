@php
// Breadcrum button Detail
$common['pagetitle']=$data['title'];
$common['btntitle']="Seva Pooja Report";
$common['btnurl']= route("Sevapooja.seva_pooja_report");
$common['breadcrumb1']="Seva Pooja";
$common['breadcrumb2']="Seva Pooja Billing";
@endphp
@extends('index',$common)
@section('pagebody')
<style>
    .submit_pooja_form:disabled {
    background-color: #6c757d; /* Gray background */
    color: #fff; /* Text color */
    cursor: not-allowed; /* Show disabled cursor */
    opacity: 0.7; /* Optional: semi-transparent */
}
</style>
<div class="pcoded-content">
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
                                        <div class="card-header">
                                            <div class="card-block">
                                                <div class="row">
                                                <div class="col-sm-10">
                                                    <h4 class="sub-title">Pooja Input </h4>
                                                </div>
                                                <div class="col-sm-2">
                                                        <a href="{{ route('Customer.create') }}" class="sub-title breadcrumb-button btn btn-primary">Add Customer</a>
                                                </div>
                                            </div>
                                                <form  method="POST" action="{{ route('Pooja.store') }}" enctype="multipart/form-data">
                                                @csrf
                                                    <div class="row text-center">
                                                        @php
                                                            $res_todays_date = gettodaydate();
                                                            $res_current_time = gettodaytime();
                                                            $get_payment_types = get_payment_types();
                                                        @endphp
                                                        <div class="col-sm-3">
                                                           <label for="date" class="form-label"><b>Date</b></label>
                                                            <input type="date" class="form-control  @error('date') is-invalid @enderror current_date" name = "date"
                                                            placeholder=""  value="{{ \Carbon\Carbon::createFromFormat('m/d/Y', $res_todays_date)->format('Y-m-d') }}">
                                                            @error('date')
                                                                <div class="invalid-feedback">{{ $res_category }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label for="time" class="form-label"><b>Time</b></label>
                                                            <input type="time" class="form-control  @error('time') is-invalid @enderror current_time" name = "time"
                                                            placeholder=""  value="{{ $res_current_time }}">
                                                            @error('time')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-sm-2">
                                                        <label for="payment_type" class="form-label"><b>Payment Type</b></label>
                                                        <select name="payment_type" class="form-control payment_type">
                                                                @foreach($get_payment_types as $id => $payment_type)
                                                                    <option value="{{ $id }}">{{ $payment_type }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('paymet_type')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-sm-4">
                                                        <label for="search_customer" class="form-label"><b>Search Customer</b></label>
                                                            <input type="text" class="form-control customer_name  @error('customer_name') is-invalid @enderror" name = "customer_name"
                                                            placeholder="Search Customer...."  value="{{ old('customer_name') }}">
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width: 100%;">
                                                                    <!-- Dropdown items will be dynamically added here -->
                                                                </div>
                                                           
                                                            @error('customer_name')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                   
                                                        <label class="col-sm-2 col-form-label pt-3"><b>Billing Description</b></label>
                                                        <div class="col-sm-10 pt-2">
                                                            <input type="text" class="form-control bill_desc  @error('bill_desc') is-invalid @enderror" name = "bill_desc"
                                                            placeholder="Billing Description"  value="{{ old('bill_desc') }}">
                                                            @error('bill_desc')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div id="rowContainer">
                                                    <div class="row sub_pooja mb-3">
                                                        <div class="col-sm-2">
                                                        <input type="input" class="form-control  @error('code') is-invalid @enderror code" name = "code"
                                                            placeholder="Code"  value="">
                                                            <input type="hidden" class="form-control pooja_id" name = "pooja_id">
                                                            @error('code')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-sm-4 pj">
                                                        <input type="input" class="form-control  @error('pooja_name') is-invalid @enderror pooja_name" name = "pooja_name"
                                                            placeholder="Pooja Name....."  value="">
                                                            <div class="dropdown-menu-pooja" aria-labelledby="dropdownMenuButton" style="width: 100%;">
                                                                    <!-- Dropdown items will be dynamically added here -->
                                                                </div>
                                                            @error('pooja_name')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-sm-1">
                                                        <input type="input" class="form-control  @error('qty') is-invalid @enderror qty" name = "qty"
                                                            placeholder="Qty"  value="" readonly = "true">
                                                            @error('qty')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-sm-2">
                                                           
                                                        <input type="input" class="form-control  @error('price') is-invalid @enderror price" name = "price"
                                                            placeholder="Price"  value="" readonly = "true">
                                                            @error('price')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-sm-2">
                                                        <input type="input" class="form-control  @error('total') is-invalid @enderror total" name = "total"
                                                            placeholder="Total"  value="" readonly = "true">
                                                            @error('total')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-sm-1 remove-btn-div">
                                                        <button type="button" class="btn btn-primary duplicate-row">
                                                         Add
                                                        </button>
                                                        </div>
                                                       
                                                    </div>
                                                    </div>
                                                    <hr>
                                                    <button type="button" class="btn btn-primary waves-effect waves-light submit_pooja_form">Submit</button>
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
    </div>
</div>
<!-- Basic Form Inputs card end -->
@endsection
@push('scripts')
<script type="text/javascript" src="{{ asset('js/custom/sevapooja.min.js') }}"></script>
@endpush





