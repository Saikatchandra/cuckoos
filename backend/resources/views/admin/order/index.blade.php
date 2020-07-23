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
                    <li class="breadcrumb-item active">Order list</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">    
                            <h3 class="card-title">Order List</h3>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Customer Name</th>
                                    <th>Total Price</th>
                                    <th>Shipping Cost</th>
                                    <th>Payment Status</th>
                                    <th>Product Count</th>
                                    <th>Status</th>
                                    <th style="width:150px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($orders->count() > 0)
                                    @foreach($orders as $order)
                                    <tr valign="middle">
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        <td>₹ {{ $order->total_price / 100 }}</td>
                                        <td>{{ $order->shipping_cost }}</td>
                                        <td>
                                            @if($order->payment_status == 0) 
                                                <span class="badge badge-warning"> Pending </span>
                                            @else
                                                <span class="badge badge-success"> Received </span>
                                            @endif
                                        </td>
                                        <td>{{ $order->product_count }}</td>
                                        <td>
                                            @if($order->status == 0) 
                                                <span class="badge badge-warning"> Pending </span>
                                            @elseif($order->status == 1)
                                                <span class="badge badge-danger"> Rejected </span>
                                            @elseif($order->status == 2)
                                                <span class="badge badge-primary"> Shipped </span>
                                            @elseif($order->status == 3)
                                                <span class="badge badge-success"> Completed </span>
                                            @endif
                                        </td>
                                        <td style="width:150px" class="d-flex">
                                             @can('order edit')<a href="{{ route('order.edit', $order->id) }}" class="btn btn-sm btn-primary mr-1"> <i class="fas fa-edit"></i> </a> @endcan
                                             @can('order view')<a href="{{ route('order.show', $order->id) }}" class="btn btn-sm btn-success mr-1"> <i class="fas fa-eye"></i> </a> @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                @else 
                                    <tr>
                                        <td colspan="8">
                                            <h4 class="pt-4 pb-4 text-center mb-0">No Orders Found</h4>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection