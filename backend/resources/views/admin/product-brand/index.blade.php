@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Brand page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Brand list</li>
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
                            <h3 class="card-title">Brand List</h3>
                            @can('brand create')<a href="{{ route('product-brand.create') }}" class="btn btn-primary">Create Brand</a>@endcan
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th style="width:150px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($brands->count() > 0)
                                    @foreach($brands as $brand)
                                    <tr valign="middle">
                                        <td>{{ $brand->id }}</td>
                                        <td>{{ $brand->name }}</td>
                                        <td>{{ $brand->slug }}</td>
                                        <td style="width:150px" class="d-flex">
                                            @can('brand edit') <a href="{{ route('product-brand.edit', $brand->id) }}" class="btn btn-sm btn-primary mr-1"> <i class="fas fa-edit"></i> </a> @endcan
                                            @can('brand view') <a href="#" class="btn btn-sm btn-success mr-1"> <i class="fas fa-eye"></i> </a> @endcan
                                            {{-- {{ route('product-brand.show', $brand->id) }} --}}
                                            @can('brand delete')<form action="{{ route('product-brand.destroy', $brand->id) }}" method="post">
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
                                        <td colspan="5">
                                            <h4 class="pt-4 pb-4 text-center mb-0">No Brands Found</h4>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{ $brands->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection