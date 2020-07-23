@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Shipping page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Shipping list</li>
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
                            <h3 class="card-title">Shipping List</h3>
                            @can('shipping create')<a href="{{ route('shipping.create') }}" class="btn btn-primary">Create Shipping</a>@endcan
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th> ID </th>
                                    <th> Name </th>
                                    <th> Phone </th>
                                    <th> Address </th>
                                    <th> Postal Code </th>
                                    <th> State </th>
                                    <th> District </th>
                                    <th> Status </th>
                                    <th style="width:150px">Action</th>
                                </tr>
                                
                            </thead>
                            <tbody>
                                @if($shippings->count() > 0)
                                    @foreach($shippings as $shipping)
                                    <tr valign="middle">
                                        <td>{{ $shipping->id }}</td>
                                        <td>{{ $shipping->name }}</td>
                                        <td>{{ $shipping->phone }}</td>
                                        <td>{{ $shipping->address }}</td>
                                        <td>{{ $shipping->postal_code }}</td>
                                        <td>{{ $shipping->state }}</td>
                                        <td>{{ $shipping->district }}</td>
                                        <td>
                                           {{ $shipping->status == 1 ? 'Default' : '' }}
                                        </td>
                                        <td style="width:150px" class="d-flex">
                                            @can('shipping edit') <a href="{{ route('shipping.edit', $shipping->id) }}" class="btn btn-sm btn-primary mr-1"> <i class="fas fa-edit"></i> </a>@endcan
                                            @can('shipping view') <a href="#" class="btn btn-sm btn-success mr-1"> <i class="fas fa-eye"></i> </a>@endcan 
                                            @can('shipping delete') <form action="{{ route('shipping.destroy', $shipping->id) }}" method="post">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                @else 
                                    <tr>
                                        <td colspan="8">
                                            <h4 class="pt-4 pb-4 text-center mb-0">No Shipping Found</h4>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{ $shippings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection