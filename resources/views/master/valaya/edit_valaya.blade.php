@php
// Breadcrum button Detail
$common['pagetitle']=$data['title'];
$common['btntitle']="Manage";
$common['btnurl']= route("Valaya.index");
$common['breadcrumb1']="Valaya";
$common['breadcrumb2']="Edit Valaya";
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
                                           
                                                <h4 class="sub-title">Valaya Edit</h4>
                                                <form  method="POST" action="{{ route('Valaya.update',['id' => $edit_valaya->id]) }}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Valaya No</label>
                                                        <div class="col-sm-10">
                                                            <input type="hidden" class="form-control" name = "valaya_id"  value = {{$edit_valaya->id}} >
                                                            <input type="text" class="form-control @error('valaya_no') is-invalid @enderror" name = "valaya_no"
                                                            placeholder="Edit Valaya No Name" value = "{{$edit_valaya->valaya_no}}" >
                                                            @error('valaya_no')
                                                            <div class="invalid-feedback">{{$message }}</div>
                                                        @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Valaya No</label>
                                                             <div class="col-sm-10">
                                                            <input type="text" class="form-control @error('valaya_name') is-invalid @enderror" name = "valaya_name"
                                                            placeholder="Edit Valaya Name" value = "{{$edit_valaya->name}}" >
                                                            @error('valaya_name')
                                                            <div class="invalid-feedback">{{$message }}</div>
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

