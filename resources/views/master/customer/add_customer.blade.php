@php
// Breadcrum button Detail
$common['pagetitle']=$data['title'];
$common['btntitle']="Manage";
$common['btnurl']= route("Customer.index");
$common['breadcrumb1']="Customer";
$common['breadcrumb2']="Add Customer";
@endphp
@extends('index',$common)
@section('pagebody')

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
                                                <h4 class="sub-title">Customer Details</h4>
                                                <form  method="POST" action="{{ route('Customer.store') }}" enctype="multipart/form-data">
                                                    @csrf
                                                     @php 
                                                     $res_valaya = get_valaya();  
                                                    @endphp
                                                   <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Customer Name</label>
                                                        <div class="col-sm-10">
                                                        <input type="text" class="form-control  @error('customer_name') is-invalid @enderror" name = "customer_name"
                                                        placeholder="Customer Name"  value="{{ old('customer_name') }}">
                                                        @error('customer_name')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Mobile No</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control  @error('mobile_no') is-invalid @enderror" name = "mobile_no"
                                                            placeholder="Mobile No"  value="{{ old('mobile_no') }}">
                                                            @error('mobile_no')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                     <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Select Valaya</label>
                                                        <div class="col-sm-10">
                                                            <select name="valaya" class="form-control">
                                                                @foreach($res_valaya as $id => $name)
                                                                    <option value="{{ $id }}">{{ $name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('valaya')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div> 
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Address</label>
                                                            <div class="col-sm-10">
                                                                    <textarea rows="5" cols="5" class="form-control @error('address') is-invalid @enderror" name="address"
                                                                        placeholder="Address">{{ old('address') }}</textarea>
                                                                        @error('address')
                                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                                        @enderror
                                                            </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Print Required</label>
                                                        <div class="col-sm-10">
                                                            <div class="form-check">
                                                                <input type="checkbox" 
                                                                    class="form-check-input" 
                                                                    name="print_required" 
                                                                    value="1"
                                                                    {{ old('print_required') ? 'checked' : '' }}>
                                                                <label class="form-check-label">Yes</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Add</button>
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

