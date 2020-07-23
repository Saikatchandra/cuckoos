@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Shipping Address Edit Page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('shipping.index') }}">Shipping List</a></li>
                    <li class="breadcrumb-item active">Edit Shipping Address</li>
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
                            <h3 class="card-title">Edit Shipping</h3>
                            @can('shipping index')<a href="{{ route('shipping.index') }}" class="btn btn-light text-dark">Shipping list</a> @endcan
                        </div>
                    </div>
                    <form action="{{ route('shipping.update', $shipping->id) }}" method="post" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8 offset-2">
                                    @include('includes.validation')
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="customerName">Customer Name</label>
                                                <input type="text" class="form-control" name="name" id="customerName" placeholder="Enter name" value="{{ $shipping->name }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="customerPhone">Customer phone</label>
                                                <input type="text" class="form-control" name="phone" id="customerPhone" placeholder="Enter phone" value="{{ $shipping->phone }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="customerPostal">Customer Postal Code</label>
                                                <input type="text" class="form-control" name="postal_code" id="customerPostal" placeholder="Enter postal code" value="{{ $shipping->postal_code }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="country">Choose Country </label>
                                                <select name="country" id="country" class="form-control">
                                                    <option @if($shipping->country == 'bangladesh') selected @endif value="bangladesh">Bangladesh</option>
                                                    <option @if($shipping->country == 'india') selected @endif value="india">India</option>
                                                    <option @if($shipping->country == 'pakistan') selected @endif value="pakistan">Pakistan</option>
                                                    <option @if($shipping->country == 'myanmar') selected @endif value="myanmar">Myanmar</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Customer address</label>
                                        <textarea name="address" id="address" placeholder="Enter your address" rows="2" class="form-control">{{ $shipping->address }}</textarea>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Update Shipping</button>
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
            $('#startDate').datetimepicker({
                format: 'YYYY-MM-DD HH:mm',
            });
            $('#endDate').datetimepicker({
                format: 'YYYY-MM-DD HH:mm',
            });
        });
    </script>
@endsection