@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Shipping Create Page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('shipping.index') }}">Shipping List</a></li>
                    <li class="breadcrumb-item active">Create Shipping</li>
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
                            <h3 class="card-title">Create Shipping</h3>
                            @can('shipping index')<a href="{{ route('shipping.index') }}" class="btn btn-light text-dark">Shipping list</a>@endcan
                        </div>
                    </div>
                    <form action="{{ route('shipping.store') }}" method="post" enctype="multipart/form-data">
                        @csrf 
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8 offset-2">
                                    @include('includes.validation')
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="customerName">Customer Name</label>
                                                <input type="text" class="form-control" name="name" id="customerName" placeholder="Enter name" value="{{ old('name') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="customerPhone">Customer phone</label>
                                                <input type="text" class="form-control" name="phone" id="customerPhone" placeholder="Enter phone" value="{{ old('phone') }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="customerPostal">Customer Postal Code</label>
                                                <input type="text" class="form-control" name="postal_code" id="customerPostal" placeholder="Enter postal code" value="{{ old('postal_code') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="country">Choose Country </label>
                                                <select name="country" id="country" class="form-control">
                                                    <option value="">Select Country</option>
                                                    <option value="bangladesh">Bangladesh</option>
                                                    <option value="india">India</option>
                                                    <option value="pakistan">Pakistan</option>
                                                    <option value="myanmar">Myanmar</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Customer address</label>
                                        <textarea name="address" id="address" placeholder="Enter your address" rows="2" class="form-control">{{ old('address') }}</textarea>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Create Shipping</button>
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