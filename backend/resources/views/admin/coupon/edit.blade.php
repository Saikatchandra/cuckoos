@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Coupon Edit Page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('coupon.index') }}">Coupon List</a></li>
                    <li class="breadcrumb-item active">Edit Coupon</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">    
                            <h3 class="card-title">Edit Coupon</h3>
                             @can('coupon index') <a href="{{ route('coupon.index') }}" class="btn btn-light text-dark">Coupon list</a> @endcan
                        </div>
                    </div>
                    <form action="{{ route('coupon.update', $coupon->id) }}" method="post" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8 offset-2">
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="couponCode">Coupon code</label>
                                                <input type="text" class="form-control" name="code" id="couponCode" placeholder="Enter code" value="{{ $coupon->code }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="type">Coupon type</label>
                                                <select name="type" id="type" class="form-control">
                                                    <option value="1" @if($coupon->type == 1) selected @endif >Percentage</option>
                                                    <option value="2" @if($coupon->type == 2) selected @endif >Amount</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="amount"> Amount </label>
                                                <input type="text" class="form-control" name="amount" placeholder="card amount" value="{{ $coupon->amount }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Coupon description</label>
                                                <input type="text" class="form-control" name="description" id="description" placeholder="Enter description" value="{{ $coupon->description }}">
                                            </div>
                                        </div>
                                    </div>
                                    <h3>Optional </h3>
                                    <hr>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="usageLimit">Usage limit</label>
                                                <input type="number" class="form-control" name="usage_limit" id="usageLimit" placeholder="Enter limit" value="{{ $coupon->usage_limit }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="limitPeruser">Limit per user</label>
                                                <input type="number" class="form-control" name="limit_peruser" id="limitPeruser" placeholder="Enter limit" value="{{ $coupon->limit_peruser }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="0" @if($coupon->status == 0) selected @endif >Disabled</option>
                                                    <option value="1" @if($coupon->status == 1) selected @endif >Active</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="minimumSpend">Minimum spend</label>
                                                <input type="text" class="form-control" name="min_spend" id="minimumSpend" placeholder="Enter min spend" value="{{ $coupon->min_spend }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="expiredDate">Expiry date</label>
                                                <input type="text" name="expiry_date" class="form-control datetimepicker-input" id="expiryDate" data-toggle="datetimepicker" data-target="#expiryDate" placeholder="Please click here to update time">
                                            </div>
                                            
                                            <div class="row  pt-4">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" type="checkbox" id="freeShipping" name="allow_freeshippping" @if($coupon->allow_freeshippping) checked @endif>
                                                            <label for="freeShipping" class="custom-control-label">Enable Free Shipping</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" name="new_user" type="checkbox" id="newUser" @if($coupon->new_user) checked @endif>
                                                            <label for="newUser" class="custom-control-label">New User Coupon? </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Update Coupon</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}" />
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('admin/plugins/moment/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            $('#expiryDate').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss',
                defaultDate: "{{ $coupon->expiry_date }}"
            });
        });
    </script>
@endsection