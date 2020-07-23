@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Order page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('order.index') }}">Order List</a></li>
                    <li class="breadcrumb-item active">Order Page</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">    
                            <h3 class="card-title">Order Details</h3>
                            @can('billing index')<a href="{{ route('order.index') }}" class="btn btn-light text-dark">Order list</a>@endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th> <strong>Customer Name : </strong> </th>
                                            <td> {{ $order->user->name }} </td>
                                        </tr>
                                        <tr>
                                            <th> <strong>Customer ID : </strong>  </th>
                                            <td> {{ $order->user_id }} </td>
                                        </tr>
                                        <tr>
                                            <th> <strong>Order Total : </strong> </th>
                                            <td> ₹ {{ $order->total_price }} </td>
                                        </tr>
                                        <tr>
                                            <th> <strong>Shipping Total : </strong> </th>
                                            <td> ₹ {{ $order->shipping_cost }} </td>
                                        </tr>
                                        <tr>
                                            <th> <strong>Payment Status : </strong> </th>
                                            <td> {{ $order->payment_status }} </td>
                                        </tr>
                                        <tr>
                                            <th> <strong>Discount Amount : </strong> </th>
                                            <td> ₹ {{ $order->discount_amount }} </td>
                                        </tr>
                                        <tr>
                                            <th> <strong>Product Count  : </strong> </th>
                                            <td> {{ $order->product_count }} </td>
                                        </tr>
                                        <tr>
                                            <th> <strong>Status : </strong> </th>
                                            <td> {!! $order->status !!} </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-6">
                                <img src="{{ asset($order->image) }}" class="img-fluid img-thumbnail" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection