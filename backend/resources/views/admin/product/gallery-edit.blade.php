@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Gallery Page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('product.gallery', ['id' => $gallery->product_id]) }}">Product Gallery</a></li>
                    <li class="breadcrumb-item active"> Edit Gallery</li>
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
                    <form action="{{ route('product.gallery.update', ['id' => $gallery->id ]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body pt-5">
                            @include('includes.validation')
                            <div class="row">
                                <div class="col-6 col-xl-4 offset-xl-4">
                                    <div class="form-group">
                                        <label for="productImage">Choose Gallery Image <small>(Max upload size- 2MB)</small> </label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="image" id="productImage">
                                            <label class="custom-file-label" for="productImage">Choose file</label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Upload Image</button>
                                    </div> 
                                </div>
                                {{-- <div class="col-6 col-xl-4">
                                    <img src="{{ asset($gallery->image) }}" alt="" class="img-fluid">
                                </div> --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection