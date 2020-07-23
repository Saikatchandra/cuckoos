@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Rating page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Rating list</li>
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
                            <h3 class="card-title">Rating List</h3>
                            @can('rating create')<a href="{{ route('rating.create') }}" class="btn btn-primary">Create Rating</a>@endcan
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
                                @if($ratings->count() > 0)
                                    @foreach($ratings as $rating)
                                    <tr valign="middle">
                                        <td>{{ $rating->id }}</td>
                                        <td>{{ $rating->name }}</td>
                                        <td>{{ $rating->slug }}</td>
                                        <td style="width:150px" class="d-flex">
                                            @can('rating edit') <a href="{{ route('rating.edit', $rating->id) }}" class="btn btn-sm btn-primary mr-1"> <i class="fas fa-edit"></i> </a> @endcan 
                                            @can('rating view') <a href="{{ route('rating.show', $rating->id) }}" class="btn btn-sm btn-success mr-1"> <i class="fas fa-eye"></i> </a> @endcan
                                            @can('rating delete') <form action="{{ route('rating.destroy', $rating->id) }}" method="post">
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
                                            <h4 class="pt-4 pb-4 text-center mb-0">No Ratings found</h4>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{ $ratings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection