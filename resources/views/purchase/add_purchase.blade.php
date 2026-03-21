@php
// Breadcrum button Detail
$common['pagetitle']=$data['title'];
$common['btntitle']="Manage";
$common['btnurl']= route("Purchase.index");
$common['breadcrumb1']="Purchase";
$common['breadcrumb2']="Add Purchase";
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
                                                <h4 class="sub-title">Purchase Input</h4>
                                                <form  method="POST" action="{{ route('Purchase.store') }}" enctype="multipart/form-data">
                                                    @csrf
                                                    @php 
                                                     $res_category = get_purchase_category(); 
                                                     $res_subcategory = get_purchase_sub_category(); 
                                                     $res_purchase_by =  get_purchase_by();
                                                     $res_purchase_type =  get_purcahse_type();
                                                    @endphp
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Select Category</label>
                                                        <div class="col-sm-10">
                                                            <select name="category" class="form-control">
                                                                @foreach($res_category as $id => $name)
                                                                    <option value="{{ $id }}">{{ $name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('category')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div> 
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Select Sub Category</label>
                                                        <div class="col-sm-10">
                                                            <select name="subcategory" class="form-control">
                                                                @foreach($res_subcategory as $sub_id => $sub_name)
                                                                    <option value="{{ $sub_id }}">{{ $sub_name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('subcategory')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div> 
                                                    </div>

                                                      <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Select Purcashe Type(Optional)</label>
                                                        <div class="col-sm-10">
                                                            <select name="type" class="form-control">
                                                                @foreach($res_purchase_type as $id => $type)
                                                                    <option value="{{ $id }}">{{ $type }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('subcategory')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div> 
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Purchase Details</label>
                                                            <div class="col-sm-10">
                                                                    <textarea rows="5" cols="5" class="form-control @error('purchase_detail') is-invalid @enderror" name="detail"
                                                                        placeholder="Enter Purchase Details">{{ old('purchase_detail') }}</textarea>
                                                                        @error('purchase_detail')
                                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                                        @enderror
                                                            </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Quantity</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control  @error('quantity') is-invalid @enderror" name = "quantity"
                                                            placeholder="Enter Quantity"  value="{{ old('quantity') }}">
                                                            @error('quantity')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                      
                                                    </div>

                                                     <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Amount</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control  @error('amount') is-invalid @enderror" name = "amount"
                                                            placeholder="Enter Amount"  value="{{ old('amount') }}">
                                                            @error('amount')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                      
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Date</label>
                                                        <div class="col-sm-10">
                                                            <input type="date" class="form-control  @error('date') is-invalid @enderror" name = "date"
                                                            placeholder="Enter Amount"  value="{{ old('date') }}">
                                                            @error('date')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
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
@push('scripts')
<script type="text/javascript" src="{{ asset('js/custom/sevapooja.min.js') }}"></script>
@endpush

