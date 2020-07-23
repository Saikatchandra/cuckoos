@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Order Edit Page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('order.index') }}">Order List</a></li>
                    <li class="breadcrumb-item active">Edit Order</li>
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
                            <h3 class="card-title">Edit Order</h3>
                           @can('product index') <a href="{{ route('order.index') }}" class="btn btn-light text-dark">Order list</a>@endcan
                        </div>
                    </div>
                    <form action="{{ route('order.update', $order->id) }}" method="post" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 offset-3">
                                    @include('includes.validation')
                                    <div class="form-group">
                                        <label for="status">Tracking Code (optional) </label>
                                        <input type="text" class="form-control" name="tracking_code" placeholder="tracking code" value="{{ $order->tracking_code }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Tracking Link (optional) </label>
                                        <input type="text" class="form-control" name="tracking_link" placeholder="tracking link" value="{{ $order->tracking_link }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Order Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="0" @if($order->status == 0) selected @endif>Pending</option>
                                            <option value="1" @if($order->status == 1) selected @endif>Rejected</option>
                                            <option value="2" @if($order->status == 2) selected @endif>Shipped</option>
                                            <option value="3" @if($order->status == 3) selected @endif>Completed</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="payment_status">Payment Status</label>
                                        <select name="payment_status" id="payment_status" class="form-control">
                                            <option value="0" @if($order->payment_status == 0) selected @endif> Pending </option>
                                            <option value="1" @if($order->payment_status == 1) selected @endif> Received </option>
                                        </select>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Update Order Data</button>
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