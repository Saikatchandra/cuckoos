@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Campaign page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Campaign list</li>
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
                            <h3 class="card-title">Campaign List</h3>
                             @can('campaign create')<a href="{{ route('campaign.create') }}" class="btn btn-primary">Create Campaign</a>@endcan
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Discount</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th style="width:160px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($campaigns->count() > 0)
                                    @foreach($campaigns as $campaign)
                                    <tr valign="middle">
                                        <td>{{ $campaign->id }}</td>
                                        <td>{{ $campaign->name }}</td>
                                        <td>
                                            @if($campaign->banner)
                                            <img style="width:50px; height:50px;border-radius:5px;object-fit:cover;" src="{{ asset($campaign->banner) }}" alt="User Avatar">
                                            @else
                                            <img style="width:50px; height:50px;border-radius:50%;object-fit:cover;" src="{{ asset('admin') }}/dist/img/user.png" alt="User Avatar">
                                            @endif
                                        </td>
                                        <td>{{ $campaign->discount }}</td>
                                        <td>@if($campaign->start_date) {{ $campaign->start_date->format('d M, Y') }} @endif</td>
                                        <td>@if($campaign->end_date) {{ $campaign->end_date->format('d M, Y') }} @endif</td>
                                        <td>
                                            @php echo $campaign->status ? 'Active' : 'Inactive'; @endphp
                                        </td>
                                        <td style="width:160px" class="d-flex">
                                            @can('campaign product') <a href="{{ route('campaign.product', $campaign->id) }}" class="btn btn-sm btn-dark mr-1"> <i class="fas fa-plus"></i> </a>@endcan
                                            @can('campaign edit') <a href="{{ route('campaign.edit', $campaign->id) }}" class="btn btn-sm btn-primary mr-1"> <i class="fas fa-edit"></i> </a> @endcan
                                            @can('campaign view') <a href="#" class="btn btn-sm btn-success mr-1"> <i class="fas fa-eye"></i> </a> @endcan 
                                            @can('campaign delete') <form action="{{ route('campaign.destroy', $campaign->id) }}" method="post">
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
                                            <h4 class="pt-4 pb-4 text-center mb-0">No Campaigns Found</h4>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{ $campaigns->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection