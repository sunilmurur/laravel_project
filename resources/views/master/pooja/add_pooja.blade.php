@php
// Breadcrum button Detail
$common['pagetitle']=$data['title'];
$common['btntitle']="Manage";
$common['btnurl']= route("Pooja.index");
$common['breadcrumb1']="Pooja";
$common['breadcrumb2']="Add Pooja";
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
                                                <h4 class="sub-title">Pooja Input</h4>
                                                <form  method="POST" action="{{ route('Pooja.store') }}" enctype="multipart/form-data">
                                                    @csrf
                                                    @php 
                                                     $res_category = get_category(); 
                                                     $res_subcategory = get_sub_category(); 
                                                        
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
                                                        <label class="col-sm-2 col-form-label">Code</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control  @error('code') is-invalid @enderror" name = "code"
                                                            placeholder="Code"  value="{{ old('code') }}">
                                                            @error('code')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                      
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Pooja Name</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control  @error('pooja_name') is-invalid @enderror" name = "pooja_name"
                                                            placeholder="Enter Pooja Name"  value="{{ old('pooja_name') }}">
                                                            @error('pooja_name')
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
                                                        <label class="col-sm-2 col-form-label">Description</label>
                                                            <div class="col-sm-10">
                                                                    <textarea rows="5" cols="5" class="form-control @error('description') is-invalid @enderror" name="description"
                                                                        placeholder="Enter Description">{{ old('description') }}</textarea>
                                                                        @error('description')
                                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                                        @enderror
                                                            </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Add</button>
                                                </form>
                                                            
                 <!--   {!! $result = customHelperFunction(); !!} -->
                                                            
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

