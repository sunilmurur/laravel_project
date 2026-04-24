@php
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
    background-color: #6c757d;
    color: #fff;
    cursor: not-allowed;
    opacity: 0.7;
}
</style>

<div class="pcoded-content">
<div class="pcoded-inner-content">
<div class="main-body">
<div class="page-wrapper">

@include('common.breadcrumb',$common)

<div class="page-body">
<div class="row">
<div class="col-sm-12">

<div class="card">
<div class="card-header">

<div class="row">
    <div class="col-sm-10">
        <h4 class="sub-title">Edit Seva Pooja</h4>
    </div>
    <div class="col-sm-2">
        <a href="{{ route('Customer.create') }}" class="btn btn-primary">Add Customer</a>
    </div>
</div>

<div class="card-block">

<form>

@csrf

<!-- ✅ Hidden -->
<input type="hidden" id="receipt_id" value="{{ $receipt->id }}">
<input type="hidden" id="purchase_customer_id" value="{{ $receipt->user_id }}">

@php
$res_todays_date = gettodaydate();
$res_current_time = gettodaytime();
$get_payment_types = get_payment_types();
@endphp

<!-- ================= HEADER ================= -->
<div class="row text-center">

<!-- Date -->
<div class="col-sm-3">
<label><b>Date</b></label>
<input type="date" class="form-control current_date"
value="{{ \Carbon\Carbon::parse($receipt->receipt_date)->format('Y-m-d') }}">
</div>

<!-- Time -->
<div class="col-sm-3">
<label><b>Time</b></label>
<input type="time" class="form-control current_time"
value="{{ $receipt->receipt_time }}">
</div>

<!-- Payment -->
<div class="col-sm-2">
<label><b>Payment Type</b></label>
<select class="form-control payment_type">
@foreach($get_payment_types as $id => $payment_type)
<option value="{{ $id }}"
{{ $receipt->payment_method_id == $id ? 'selected' : '' }}>
{{ $payment_type }}
</option>
@endforeach
</select>
</div>

<!-- Customer -->
<div class="col-sm-4">
<label><b>Search Customer</b></label>
<input type="text" class="form-control customer_name"
value="{{ $receipt->customer_name }}">
<div class="dropdown-menu" style="width:100%"></div>
</div>

<!-- Billing Desc -->
<label class="col-sm-2 col-form-label pt-3"><b>Billing Description</b></label>
<div class="col-sm-10 pt-2">
<input type="text" class="form-control bill_desc"
value="{{ $receipt->bill_desc }}">
</div>

</div>

<hr>

<!-- ================= ITEMS ================= -->
<div id="rowContainer">

@foreach($items as $key => $item)
<div class="row sub_pooja mb-3">

<div class="col-sm-2">
<input type="text" class="form-control code"
value="{{ $item->pooja_code }}">
<input type="hidden" class="pooja_id"
value="{{ $item->pooja_id }}">
</div>

<div class="col-sm-4">
<input type="text" class="form-control pooja_name"
value="{{ $item->pooja_name }}">
<div class="dropdown-menu-pooja" aria-labelledby="dropdownMenuButton" style="width: 100%;"></div>
</div>

<div class="col-sm-1">
<input type="text" class="form-control qty"
value="{{ $item->qty }}">
</div>

<div class="col-sm-2">
<input type="text" class="form-control price"
value="{{ $item->price }}">
</div>

<div class="col-sm-2">
<input type="text" class="form-control total"
value="{{ $item->total }}">
</div>

<div class="col-sm-1">
@if($key == 0)
<button type="button" class="btn btn-primary duplicate-row">Add</button>
@else
<button type="button" class="btn btn-danger remove-row">Remove</button>
@endif
</div>

</div>
@endforeach

@if(count($items) == 0)
<div class="row sub_pooja mb-3">

<div class="col-sm-2">
<input type="text" class="form-control code">
<input type="hidden" class="pooja_id">
</div>

<div class="col-sm-4">
<input type="text" class="form-control pooja_name">
<div class="dropdown-menu-pooja" aria-labelledby="dropdownMenuButton" style="width: 100%;"></div>
</div>

<div class="col-sm-1">
<input type="text" class="form-control qty">
</div>

<div class="col-sm-2">
<input type="text" class="form-control price">
</div>

<div class="col-sm-2">
<input type="text" class="form-control total">
</div>

<div class="col-sm-1">
<button type="button" class="btn btn-primary duplicate-row">Add</button>
</div>

</div>
@endif

</div>

<hr>

<!-- ================= SUBMIT ================= -->
<button type="button" class="btn btn-primary submit_pooja_form">
Update
</button>

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

@endsection

@push('scripts')
<script src="{{ asset('js/custom/data-table/edit-sevapooja.min.js') }}"></script>
@endpush