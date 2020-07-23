@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Billing page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Billing list</li>
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
                            <h3 class="card-title">Billing List</h3>
                            @can('billing create')<a href="{{ route('billing.create') }}" class="btn btn-primary">Create Billing</a>@endcan
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th> ID </th>
                                    <th> Card Owner </th>
                                    <th> Card Type </th>
                                    <th> Expired Date </th>
                                    <th> Card last4 </th>
                                    <th> Status </th>
                                    <th style="width:150px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($billings->count() > 0)
                                    @foreach($billings as $billing)
                                    <tr valign="middle">
                                        <td>{{ $billing->id }}</td>
                                        <td>{{ $billing->owner }}</td>
                                        <td>{{ $billing->type }}</td>
                                        <td>{{ $billing->expire_date }}</td>
                                        <td>{{ $billing->last4 }}</td>
                                        <td>
                                            @php echo $billing->status == 1 ? 'Default' : ''; @endphp
                                        </td>
                                        <td style="width:150px" class="d-flex">
                                            <a href="{{ route('billing.edit', $billing->id) }}" class="btn btn-sm btn-primary mr-1"> <i class="fas fa-edit"></i> </a>
                                            <a href="#" class="btn btn-sm btn-success mr-1"> <i class="fas fa-eye"></i> </a>
                                            <form action="{{ route('billing.destroy', $billing->id) }}" method="post">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else 
                                    <tr>
                                        <td colspan="8">
                                            <h4 class="pt-4 pb-4 text-center mb-0">No Billing Address Found</h4>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{ $billings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection