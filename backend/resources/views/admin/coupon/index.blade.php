@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Coupon page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Coupon list</li>
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
                            <h3 class="card-title">Coupon List</h3>
                            @can('coupon create') <a href="{{ route('coupon.create') }}" class="btn btn-primary">Create Coupon</a> @endcan
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Code</th>
                                    <th>Description</th>
                                    <th>Coupon Type</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th style="width:150px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($coupons->count() > 0)
                                    @foreach($coupons as $coupon)
                                    <tr valign="middle">
                                        <td>{{ $coupon->id }}</td>
                                        <td>{{ $coupon->code }}</td>
                                        <td>{{ $coupon->description }}</td>
                                        <td>
                                            @php echo $coupon->type == 1 ? 'Percentage' : 'Amount'; @endphp
                                        </td>
                                        <td>{{ $coupon->amount }}</td>
                                        <td>
                                            @php echo $coupon->status ? 'Active' : 'Disable'; @endphp
                                        </td>
                                        <td style="width:150px" class="d-flex">
                                           @can('coupon edit') <a href="{{ route('coupon.edit', $coupon->id) }}" class="btn btn-sm btn-primary mr-1"> <i class="fas fa-edit"></i> </a> @endcan
                                           @can('coupon view') <a href="#" class="btn btn-sm btn-success mr-1"> <i class="fas fa-eye"></i> </a> @endcan
                                           @can('coupon delete') <form action="{{ route('coupon.destroy', $coupon->id) }}" method="post">
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
                                        <td colspan="7">
                                            <h4 class="pt-4 pb-4 text-center mb-0">No Coupons Found</h4>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="card-footer">
                        {{ $coupons->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection