@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Product Category page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('product-category.index') }}">Product Category List</a></li>
                    <li class="breadcrumb-item active">Product Category Page</li>
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
                            <h3 class="card-title">Product Category Details</h3>
                           @can('category index') <a href="{{ route('product-category.index') }}" class="btn btn-light text-dark">Product Category list</a> @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <div><strong>Category Name : </strong> {{ $category->name }}</div>
                        <div><strong>Category Slug : </strong> {{ $category->slug }}</div>
                        <div><strong>Product Counts : </strong> {{ $category->product_count }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection