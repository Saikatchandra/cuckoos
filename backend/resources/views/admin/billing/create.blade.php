@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Billing Create Page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('billing.index') }}">Billing List</a></li>
                    <li class="breadcrumb-item active">Create Billing</li>
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
                            <h3 class="card-title">Create Billing</h3>
                            @can('billing index')<a href="{{ route('billing.index') }}" class="btn btn-light text-dark">Billing list</a>@endcan
                        </div>
                    </div>
                    <form action="{{ route('billing.store') }}" method="post" enctype="multipart/form-data">
                        @csrf 
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8 offset-2">
                                    @include('includes.validation')
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="customerName">Customer Name</label>
                                                <input type="text" class="form-control" name="owner" id="customerName" placeholder="Enter owner" value="{{ old('owner') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="type">Card Type</label>
                                                <select name="type" id="type" class="form-control">
                                                    <option value="">Select Card Type</option>
                                                    <option value="mastercard">Mastercard</option>
                                                    <option value="visa">Visa</option>
                                                    <option value="express">American Express</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="expiredDate">Card Expired Date</label>
                                                <input type="text" class="form-control" name="expire_date" id="expiredDate" placeholder="Enter expire date" value="{{ old('expire_date') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="last4">Card Last 4 Number </label>
                                                <input type="text" class="form-control" name="last4" placeholder="card last4" value="{{ old('last4') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Create Billing</button>
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