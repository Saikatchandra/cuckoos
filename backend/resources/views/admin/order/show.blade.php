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
                            <div>
                                @can('order index')<a href="{{ route('order.index') }}" class="btn btn-light text-dark">Order list</a> @endcan
                                @can('order edit')<a href="{{ route('order.edit', $order->id) }}" class="btn btn-dark">Edit Order</a> @endcan
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col">
                                        <strong>Customer Name :</strong>
                                        {{ $order->user->name }}
                                    </div>
                                    <div class="col">
                                        <strong>Customer ID :</strong>
                                        {{ $order->user_id }}
                                    </div>
                                    <div class="col">
                                        <strong>Order Total :</strong>
                                        ₹ {{ $order->total_price / 100 }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <strong>Shipping Total :</strong>
                                        ₹ {{ $order->shipping_cost }}
                                    </div>
                                    <div class="col">
                                        <strong>Payment Status :</strong>
                                        ₹ {{ $order->payment_status }}
                                    </div>
                                    <div class="col">
                                        <strong>Status :</strong>
                                        {!! $order->status !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <strong>Product Count :</strong>
                                        {{ $order->product_count }}
                                    </div>
                                    <div class="col">
                                        <strong>Customer Name :</strong>
                                        {{ $order->customer_name }}
                                    </div>
                                    <div class="col">
                                        <strong>Customer Phone :</strong>
                                        {!! $order->customer_phone !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <strong>Customer Address :</strong>
                                        {{ $order->customer_address }}
                                    </div>
                                    <div class="col">
                                        <strong>Payment Id :</strong>
                                        {{ $order->payment_id }}
                                    </div>
                                    <div class="col">
                                        {{-- <strong>Customer Phone :</strong>
                                        {!! $order->customer_phone !!} --}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <strong>Coupon code :</strong>
                                        {{ $order->coupon_code }}
                                    </div>
                                    <div class="col">
                                        <strong>Coupon type :</strong>
                                        {{ $order->coupon_type }}
                                    </div>
                                    <div class="col">
                                        <strong>Coupon amount :</strong>
                                        {!! $order->coupon_amount !!}
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 pt-5 mt-4">
                                <h2 class="text-center mb-3">Ordered Products</h2>
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th> ID </th>
                                            <th> Image </th>
                                            <th> Title </th>
                                            <th> Price </th>
                                            <th> Quantity </th>
                                            <th> Attribute </th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->products as $product)
                                        <tr>
                                            <td> {{ $product->id }} </td>
                                            <td> 
                                                <div style="width: 70px; height: 70px; overflow:hidden">
                                                    <img class="img-fluid img-rounded" src="{{ $product->image }}" alt="">
                                                </div>
                                            </td>
                                            <td> {{ $product->title }} </td>
                                            <td> ₹ {{ $product->price / 100 }} </td>
                                            <td> {{ $product->qty }} </td>
                                            <td> Hello </td>
                                            <td> 
                                                <a href="#" class="btn btn-sm btn-primary mr-1"> <i class="fas fa-edit"></i> </a>
                                                <a href="#" class="btn btn-sm btn-success mr-1"> <i class="fas fa-eye"></i> </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if($transaction)
                        <div class="row mt-4">
                            <div class="col-12">
                                <h2 class="text-center mb-3">Transaction History</h2>
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Id</th>
                                            <th>Points</th>
                                            <th>Type </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $transaction->id }}</td>
                                            <td>{{ $transaction->amount }}</td>
                                            <td>
                                                @if($transaction->type == 1)
                                                    <div class="btn btn-success">Deposit</div>
                                                @else 
                                                    <div class="btn btn-danger"> Expense </div>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection