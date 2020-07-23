@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Product Gallery page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Product Gallery list</li>
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
                    <form action="{{ route('product.gallery.store', ['id' => $product->id ]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body pt-5">
                            @include('includes.validation')
                            <div class="row">
                                <div class="col-6 col-xl-4 offset-xl-4">
                                    <div class="form-group">
                                        <label for="productImage">Choose Gallery Image <small>(Max upload size- 2MB)</small> </label>
                                        <div id="uploadGroup">
                                            <div class="d-flex align-items-center">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="image[]" id="productImage">
                                                    <label class="custom-file-label" for="productImage">Choose file</label>
                                                </div>
                                                <div id="addItem" class="btn btn-primary ml-1"> <i class="fas fa-plus"></i> </div>    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8 col-xl-4 offset-xl-4">
                                    <hr>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Upload Image</button>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">    
                            <h3 class="card-title"> Product Gallery List </h3>
                            <a href="{{ route('product.index') }}" class="btn btn-primary"> Product List </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th style="width:150px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($product->galleries->count() > 0)
                                @foreach($product->galleries as $gallery)
                                <tr>
                                    <td>{{ $gallery->id }}</td>
                                    <td> <img style="width:50px; height:50px;border-radius:5px;object-fit:cover;" src="{{ asset($gallery->image) }}" alt="Product Image"> </td>
                                    <td style="width:150px" class="d-flex">
                                       @can('gallery edit') <a href="{{ route('product.gallery.edit', ['id' => $gallery->id]) }}" class="btn btn-sm btn-primary mr-1"> <i class="fas fa-edit"></i> </a> @endcan
                                       @can('gallery delete') <a target="_blank" href="{{ asset($gallery->image) }}" class="btn btn-sm btn-success mr-1"> <i class="fas fa-eye"></i> </a>
                                        <form action="{{ route('product.gallery.destroy', ['id' => $gallery->id]) }}" method="post">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form> @endcan
                                    </td>
                                </tr>
                                @endforeach
                                @else 
                                    <tr>
                                        <td colspan="3">
                                            <h5 class="text-center pt-5 pb-5">No Image Found.</h5>
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
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            function Generator() {};
                Generator.prototype.rand =  Math.floor(Math.random() * 26) + Date.now();
                Generator.prototype.getId = function() {
                return this.rand++;
            };

            var idGen = new Generator();

            // Add Upload Input Item
            $('#addItem').on('click', function(){
                let id = idGen.getId()
                $('#uploadGroup').append(`
                    <div class="d-flex align-items-center mt-2 mb-2 upload-item">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image[]" id="`+id+`">
                            <label class="custom-file-label" for="`+id+`">Choose file</label>
                        </div>
                        <div class="removeItem btn btn-danger ml-1"> <i class="fas fa-minus"></i> </div>    
                    </div>
                `);
                
                bsCustomFileInput.init();
            });

            $('#uploadGroup').on('click', '.removeItem', function(e){
                $(this).closest('.upload-item').remove();
            });
        });
    
    </script>
@endsection