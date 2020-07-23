@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Campaign Products</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"> <a href="{{ route('campaign.index') }}">Campaign</a> </li>
                    <li class="breadcrumb-item"> Add Products
                    </li>
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
                            <h3 class="card-title">Campaign Product List</h3>
                             @can('campaign index') <a href="{{ route('campaign.index') }}" class="btn btn-primary">Campaign List </a> @endcan
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="row mb-5 mt-4">
                            <div class="col-12">
                                <form action="{{ route('campaign.product.update', $campaign->id) }}" method="POST" class="p-4">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">Choose Products</label>
                                        <select name="products[]" id="multiple" class="form-control" multiple>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id}}"> {{ $product->title}} </option>
                                            @endforeach
                                            @foreach($excludeProducts as $product)
                                                <option value="{{ $product->id}}" selected> {{ $product->title}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-success" type="submit"> Update Products </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>SKU</th>
                                        <th style="width:150px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($campaignProducts->count() > 0)
                                        @foreach($campaignProducts as $product)
                                        <tr valign="middle">
                                            <td>{{ $product->id }}</td>
                                            <td>
                                                @if($product->image)
                                                <img style="width:50px; height:50px;border-radius:5px;object-fit:cover;" src="{{ asset($product->image) }}" alt="Product Image">
                                                @endif
                                            </td>
                                            <td> {{ $product->title }} </td>
                                            <td> {{ $product->category->name }} </td>
                                            <td> {{ $product->brand->name }} </td>
                                            <td> 
                                                @if($product->sale_price)
                                                    <strong> ₹ {{ $product->sale_price / 100 }} </strong> <span style="text-decoration:line-through">₹ {{ $product->price / 100 }}</span>
                                                @else 
                                                    <strong> ₹ {{ $product->price / 100 }} </strong>
                                                @endif
                                            </td>
                                            <td> {{ $product->stock }} </td>
                                            <td> {{ $product->sku }} </td>
                                            <td style="width:150px" class="d-flex flex-wrap">
                                                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-primary mr-1"> <i class="fas fa-edit"></i> </a>
                                                <a href="{{ route('product.show', $product->id) }}" class="btn btn-sm btn-success mr-1"> <i class="fas fa-eye"></i> </a>
                                                <form action="{{ route('product.destroy', $product->id) }}" method="post">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                                <a href="{{ route('product.gallery', $product->id) }}" class="btn btn-sm btn-warning mt-1 mr-1"> <i class="fas fa-image"></i> </a>
                                                <a href="{{ route('product.attribute', $product->id) }}" class="btn btn-sm btn-info mt-1 mr-1"> <i class="fas fa-plus"></i> </a>
                                                <a href="#" class="btn btn-sm btn-dark mt-1 mr-1"> <i class="fas fa-link"></i> </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else 
                                        <tr>
                                            <td colspan="9">
                                                <h4 class="pt-4 pb-4 text-center mb-0">No products found</h4>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('admin') }}/plugins/select2/css/select2.min.css">
{{-- <link rel="stylesheet" href="{{ asset('admin') }}/plugins/select2/css/select2-bootstrap4.css"> --}}
{{-- <link rel="stylesheet" href="{{ asset('admin') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css"> --}}
<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        color: #343a40;
        background-color: white;
    }

    .select2-results__option[aria-selected=true] {
        display: none;
    }
</style>
@endsection

@section('script')
<!-- Select2 -->
<script src="{{ asset('admin') }}/plugins/select2/js/select2.full.min.js"></script>
<script>
    $("#multiple").select2({
        placeholder: "Select Products"
    });
</script>
@endsection