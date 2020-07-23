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
                    <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Product List</a></li>
                    <li class="breadcrumb-item active">Product Page</li>
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
                            <h3 class="card-title">Product Details</h3>
                            @can('product index') <a href="{{ route('product.index') }}" class="btn btn-light text-dark">Product list</a> @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <table class="table bordered">
                                    <tr>
                                        <th> Product Name: </th>
                                        <td> {{ $product->title }} </td>
                                    </tr>
                                    <tr>
                                        <th> Category : </th>
                                        <td>  {{ $product->category->name }}</td>
                                    </tr>
                                    @if($product->subcategory)
                                    <tr>
                                        <th> Sub Category : </th>
                                        <td> {{ $product->subcategory->name }}</td>
                                    </tr>
                                    @endif
                                    @if($product->brand)
                                    <tr>
                                        <th> Sub Category : </th>
                                        <td> {{ $product->brand->name }} </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <th> Stock : </th>
                                        <td>  {{ $product->stock }}</td>
                                    </tr>
                                    <tr>
                                        <th> Price : </th>
                                        <td>  ₹ {{ $product->price / 100 }}</td>
                                        </tr>
                                    <tr>
                                        <th> Sale Price : ths
                                        <td> trong> ₹ {{ $product->sale_price / 100 }}</td>
                                    </tr>
                                    <tr>
                                        <th> SKU : </th>
                                        <td>  {{ $product->sku }}</td>
                                    </tr>
                                    <tr>
                                        <th> Comission : </th>
                                        <td>  {{ $product->comission }}</td>
                                    </tr>
                                    <tr>
                                        <th> Origin : </th>
                                        <td>  {{ $product->origin }}</td>
                                    </tr>
                                    <tr>
                                        <th> Recommended: </th>
                                        <td>
                                            @if($product->recommended)
                                            <div class="badge badge-success">Recommended</div>
                                            @else 
                                            <div class="badge badge-secondary">Not Recommended</div>
                                            @endif    
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> Created  : </th>
                                        <td> {{ $product->created_at->format('d M, Y') }} </td>
                                    </tr>
                                    <tr>
                                        <th> Description : </th>
                                        <td> {!! $product->description !!} </td>
                                    </tr>
                                    <tr>
                                        <th> Information : </th>
                                        <td> {!! $product->information !!} </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-6">
                                <img src="{{ asset($product->image) }}" class="img-fluid img-thumbnail" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection