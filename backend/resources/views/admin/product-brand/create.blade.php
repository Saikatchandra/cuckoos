@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Brand Create Page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('product-brand.index') }}">Product Brand List</a></li>
                    <li class="breadcrumb-item active">Create Product Brand</li>
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
                            <h3 class="card-title">Create Product Brand</h3>
                            @can('brand index') <a href="{{ route('product-brand.index') }}" class="btn btn-light text-dark">Product Brand list</a> @endcan
                        </div>
                    </div>
                    <form action="{{ route('product-brand.store') }}" method="post" enctype="multipart/form-data">
                        @csrf 
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 offset-3">
                                    @include('includes.validation')
                                    <div class="form-group">
                                        <label for="userName">Product Brand Name</label>
                                        <input type="text" class="form-control" name="name" id="userName" placeholder="Enter name" value="{{ old('name') }}">
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Create Product Brand</button>
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