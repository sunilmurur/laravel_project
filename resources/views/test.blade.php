@extends('index')
@section('pagebody')
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                @include('common.breadcrumb')
                    <div class="page-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- Basic Form Inputs card start -->
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-block">
                                                <h4 class="sub-title">Segment Input</h4>
                                                <form>
                                                    
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Segment Name</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control"
                                                            placeholder="Enter Segment Name">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                                    <label class="col-sm-2 col-form-label">Segment Description</label>
                                                                    <div class="col-sm-10">
                                                                        <textarea rows="5" cols="5" class="form-control"
                                                                        placeholder="Enter Segment Description"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 col-form-label">Segment Image</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="file" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Status</label>
                                                            <div class="col-sm-10">
                                                                <select name="select" class="form-control">
                                                                    <option value="opt1">Online</option>
                                                                    <option value="opt2">Offline</option>
                                                                </select>
                                                            </div>
                                                            
                                                            
                                                        </div>
                                                </form>
                                                            
                    {!! $result = customHelperFunction(); !!}
                                                            
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                
                                <div id="styleSelector">
                                
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

