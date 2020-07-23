@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Import Products Page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Product List</a></li>
                    <li class="breadcrumb-item active">Import Product</li>
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
                            <h3 class="card-title">Import Product</h3>
                            @can('product index')<a href="{{ route('product.index') }}" class="btn btn-light text-dark">Product list</a>@endcan
                        </div>
                    </div>
                    <form action="{{ route('product.import.store') }}" method="post" enctype="multipart/form-data">
                        @csrf 
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 offset-3">
                                    @include('includes.validation')
                                    <div class="form-group">
                                        <label for="userName">Choose Excel File</label>
                                        <input type="file" class="form-control" name="importfile" id="userName">
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <button type="submit" class="btn btn-primary">Import Products</button>
                                            </div>
                                            <div class="col-6 text-right">
                                                <a href="{{ asset('file/demo.xlsx') }}" download target="_blank" class="btn btn-info btn-sm">Download Sample</a>
                                            </div>
                                        </div>
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