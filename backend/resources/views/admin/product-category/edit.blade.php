@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Category Edit Page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('product-category.index') }}">Product Category List</a></li>
                    <li class="breadcrumb-item active">Edit Product Category</li>
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
                            <h3 class="card-title">Edit Product Category</h3>
                           @can('category index') <a href="{{ route('product-category.index') }}" class="btn btn-light text-dark">Product Category list</a> @endcan 
                        </div>
                    </div>
                    <form action="{{ route('product-category.update', $category->id) }}" method="post" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 offset-3">
                                    @include('includes.validation')
                                    <div class="form-group">
                                        <label for="userName">Product Category Name</label>
                                        <input type="text" class="form-control" name="name" id="userName" placeholder="Enter name" value="{{ $category->name }}">
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Update Product Category</button>
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