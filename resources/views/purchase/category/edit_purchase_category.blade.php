@php
// Breadcrum button Detail
$common['pagetitle']=$data['title'];
$common['btntitle']="Manage";
$common['btnurl']= route("Purchasecategory.index");
$common['breadcrumb1']="Purchase Category";
$common['breadcrumb2']="Edit Purchase Category";
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
                                           
                                                <h4 class="sub-title">Category Edit</h4>
                                                <form  method="POST" action="{{ route('Purchasecategory.update',['id' => $edit_category->id]) }}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Category Name</label>
                                                        <div class="col-sm-10">
                                                            <input type="hidden" class="form-control" name = "category_id"  value = {{$edit_category->id}} >
                                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name = "name"
                                                            placeholder="Enter Category Name" value = "{{$edit_category->name}}" >
                                                            @error('name')
                                                            <div class="invalid-feedback">{{$message }}</div>
                                                        @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Category Description</label>
                                                            <div class="col-sm-10">
                                                                    <textarea rows="5" cols="5" class="form-control @error('description') is-invalid @enderror" name="description"
                                                                        placeholder="Enter Category Description">{{$edit_category->description}}</textarea>
                                                                        @error('description')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                            </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
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

