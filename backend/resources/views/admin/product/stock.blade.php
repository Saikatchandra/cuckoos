@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Product page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Product list</li>
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
                            <h3 class="card-title">Product List</h3>
                            <div>
                               @can('product create') <a href="{{ route('product.create') }}" class="btn btn-primary">Create Product</a> @endcan
                               @can('product import') <a href="{{ route('product.import') }}" class="btn btn-primary">Import Product</a> @endcan
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
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
                                @if($products->count() > 0)
                                    @foreach($products as $product)
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
                                                <strong> ₹ {{ $product->sale_price / 100}} </strong> <span style="text-decoration:line-through">₹ {{ $product->price / 100 }}</span>
                                            @else 
                                                <strong> ₹ {{ $product->price / 100 }} </strong>
                                            @endif
                                         </td>
                                        <td> {{ $product->stock }} </td>
                                        <td> {{ $product->sku }} </td>
                                        <td style="width:150px" class="d-flex flex-wrap">
                                            @can('product edit')<a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-primary mr-1"> <i class="fas fa-edit"></i> </a>@endcan
                                            @can('product view')<a href="{{ route('product.show', $product->id) }}" class="btn btn-sm btn-success mr-1"> <i class="fas fa-eye"></i> </a>@endcan
                                            @can('product delete')<form action="{{ route('product.destroy', $product->id) }}" method="post">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                            @endcan
                                            @can('product gallery') <a href="{{ route('product.gallery', $product->id) }}" class="btn btn-sm btn-warning mt-1 mr-1"> <i class="fas fa-image"></i> </a> @endcan
                                            @can('product attribute') <a href="{{ route('product.attribute', $product->id) }}" class="btn btn-sm btn-info mt-1 mr-1"> <i class="fas fa-plus"></i> </a> @endcan
                                            <a href="#" class="btn btn-sm btn-dark mt-1 mr-1"> <i class="fas fa-link"></i> </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else 
                                    <tr>
                                        <td colspan="9">
                                            <h4 class="pt-4 pb-4 text-center mb-0">No Products Found</h4>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection