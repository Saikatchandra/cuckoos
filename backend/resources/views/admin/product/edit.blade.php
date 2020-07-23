@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Product Edit Page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Product List</a></li>
                    <li class="breadcrumb-item active">Edit Product</li>
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
                            <h3 class="card-title">Edit Product</h3>
                            @can('product index') <a href="{{ route('product.index') }}" class="btn btn-light text-dark">Product list</a> @endcan
                        </div>
                    </div>
                    <form action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="card-body">
                            @include('includes.validation')
                            <div class="row">
                                <div class="col-6 col-xl-5 offset-xl-1">
                                    <div class="form-group">
                                        <label for="productTitle">Product Title</label>
                                        <input type="text" class="form-control" name="title" id="productTitle" placeholder="Enter title" value="{{ $product->title }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="productCategory">Select Category</label>
                                        <select name="category" id="productCategory" class="form-control">
                                            <option value="" style="display:none;" selected> Select Category </option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" @if($product->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="productSubCategory">Sub Select Category</label>
                                        <select name="subcategory" id="productSubCategory" class="form-control">
                                            @foreach($subcategories as $category)
                                                <option value="{{ $category->id }}" @if($product->subcategory_id == $category->id) selected @endif>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="productBrand">Select Brand</label>
                                        <select name="brand" id="productBrand" class="form-control">
                                            <option value="" style="display:none;" selected> Select Brand </option>
                                            @foreach($brands as $brand)
                                                <option value="{{ $brand->id }}" @if($product->brand_id == $brand->id) selected @endif>{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="number" step=".01" id="price" name="price" class="form-control" placeholder="Enter product price" value="{{ $product->price / 100 }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="sale_price">Sale Price</label>
                                        <input type="number" step=".01" id="sale_price" name="sale_price" class="form-control" placeholder="Enter product sale price" value="@if($product->sale_price){{ $product->sale_price / 100 }}@endif">
                                    </div>
                                    <div class="form-group">
                                        <label for="stock">Stock</label>
                                        <input type="text" id="stock" name="stock" class="form-control" placeholder="Enter product stock" value="{{ $product->stock }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="sku">SKU</label>
                                        <input type="text" id="sku" name="sku" class="form-control" placeholder="Enter product sku" value="{{ $product->sku }}">
                                    </div>
                                </div>
                                <div class="col-6 col-xl-5">
                                    <div class="form-group">
                                        <label for="origin"> Product Origin </label>
                                        <input type="text" id="origin" name="origin" class="form-control" value="{{ $product->origin }}" placeholder="Enter product origin">
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="checkbox" name="recommended" class="form-check-input" id="recommendCheck" @if($product->recommended) checked @endif>
                                            <label class="form-check-label" style="user-select: none" for="recommendCheck">Recommended Product</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="comission">Affiliate Comission</label>
                                        <input type="number" step=".01" id="comission" name="comission" class="form-control" value="{{ $product->comission / 100 }}" placeholder="Enter product comission">
                                    </div>
                                    <div class="form-group">
                                        <label for="productImage">Product Image</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="image" id="productImage">
                                            <label class="custom-file-label" for="productImage">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Product Description</label>
                                        <textarea name="description" id="description" class="form-control" rows="5" placeholder="Description">{{ $product->description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="information">Product Information</label>
                                        <textarea name="information" id="information" class="form-control" rows="5" placeholder="Information">{{ $product->information }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-xl-10 offset-xl-1">
                                    <hr>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Update Product Details</button>
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
<link rel="stylesheet" href="{{ asset('admin') }}/plugins/ckeditor/css/sample.css">
@endsection

@section('script')
<script src="{{ asset('admin') }}/plugins/ckeditor/js/ckeditor.js"></script>
<script>
    // Editor for Description
	ClassicEditor.create( document.querySelector( '#description' ), {
        // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
    } )
    .then( editor => {
        window.editor = editor;
        editor.editing.view.change( writer => {
            writer.setStyle( 'height', '120px', editor.editing.view.document.getRoot() );
        });
    } )
    .catch( err => {
        console.error( err.stack );
    } );

    // Editor for Information
	ClassicEditor.create( document.querySelector( '#information' ), {
        // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
    } )
    .then( editor => {
        window.editor = editor;
        editor.editing.view.change( writer => {
            writer.setStyle( 'height', '120px', editor.editing.view.document.getRoot() );
        });
    } )
    .catch( err => {
        console.error( err.stack );
    } );
    
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    $('#productCategory').on('change', function() {
        // Does some stuff and logs the event to the console
       loadSubCategories(this.value);
    });

    function loadSubCategories(categoryId) {
        $.ajax({
            type:'GET',
            url:'/get/subctegories/'+ categoryId,
            success: function(data){
                $('#productSubCategory').html('');
                $.each(data, function( key, value ) {
                    $('#productSubCategory').prepend(`
                        <option value="`+value.id+`">`+ value.name+`</option>
                    `);
                });
            }
        });
    }
</script>
@endsection