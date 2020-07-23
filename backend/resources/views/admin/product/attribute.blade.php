@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Product Attribute page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Product Attribute list</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('product.attribute.store', ['id' => $product->id ]) }}" method="post" enctype="multipart/form-data">
                    <div class="card card-primary">
                        @csrf
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">    
                                <h3 class="card-title"> Create Product Attributes </h3>
                                <a href="{{ route('product.index') }}" class="btn btn-light text-dark"> Product List </a>
                            </div>
                        </div>
                        <div class="card-body pt-5">
                            @include('includes.validation')
                            <div class="row">
                                <div class="col-8 col-xl-8 offset-xl-2">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th> SKU </th>
                                                <th> Type </th>
                                                <th> Name </th>
                                                <th> Value </th>
                                                <th> Price <small>(Optional)</small> </th>
                                                <th> Stock </th>
                                                <th> <div id="addItem" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></div> </th>
                                            </tr>
                                        </thead>
                                        <tbody id="itemParent">
                                            <tr>
                                                <td> <input type="text" name="sku[]" class="form-control" placeholder="Enter sku"> </td>
                                                <td> <input type="text" name="type[]" class="form-control" placeholder="Enter type"> </td>
                                                <td> <input type="text" name="name[]" class="form-control" placeholder="Enter name"> </td>
                                                <td> <input type="text" name="value[]" class="form-control" placeholder="Enter value"> </td>
                                                <td> <input type="number" step=".01" name="price[]" class="form-control" placeholder="Enter price"> </td>
                                                <td> <input type="text" name="stock[]" class="form-control" placeholder="Enter stock"> </td>
                                                <td>  </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8 col-xl-8 offset-xl-2">
                                    <hr>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Upload Attributes</button>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Product Attribute List </h3>
                        {{-- <div class="d-flex justify-content-between align-items-center">    
                        </div> --}}
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>SKU</th>
                                    <th>Type</th>
                                    <th>Name</th>
                                    <th>Value</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th style="width:100px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($product->attributes->count() > 0)
                                @foreach($product->attributes as $attribute)
                                <tr>
                                    <td>{{ $attribute->id }}</td>
                                    <td> {{ $attribute->sku }} </td>
                                    <td> {{ $attribute->type }} </td>
                                    <td> {{ $attribute->name }} </td>
                                    <td> {{ $attribute->value }} </td>
                                    <td> ₹ {{ $attribute->price }} </td>
                                    <td> {{ $attribute->stock }} </td>
                                    <td style="width:100px" class="d-flex">
                                         @can('attribute delete')<form action="{{ route('product.attribute.destroy', ['id' => $attribute->id]) }}" method="post">
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
                                        <td colspan="8">
                                            <h5 class="text-center pt-5 pb-5">No Attributes Found.</h5>
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
                $('#itemParent').append(`
                    <tr class="appendedItem">
                        <td> <input type="text" name="sku[]" class="form-control" placeholder="Enter sku"> </td>
                        <td> <input type="text" name="type[]" class="form-control" placeholder="Enter type"> </td>
                        <td> <input type="text" name="name[]" class="form-control" placeholder="Enter name"> </td>
                        <td> <input type="text" name="value[]" class="form-control" placeholder="Enter value"> </td>
                        <td> <input type="number" step=".01" name="price[]" class="form-control" placeholder="Enter price"> </td>
                        <td> <input type="text" name="stock[]" class="form-control" placeholder="Enter stock"> </td>
                        <td> <div id="removeItem" class="btn btn-danger btn-sm"><i class="fas fa-minus"></i></div> </td>
                    </tr>
                `);
            });

            $('#itemParent').on('click', '#removeItem', function(e){
                $(this).closest('.appendedItem').remove();
            });
        });
    
    </script>
@endsection