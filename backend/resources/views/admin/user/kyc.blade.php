@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">User KYC page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">User KYC Information list</li>
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
                            <h3 class="card-title">User KYC Information list</h3>
                            @can('user index')<a href="{{ route('user.index') }}" class="btn btn-primary">User List</a> @endcan
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User ID</th>
                                    <th>Pen Card</th>
                                    <th>Aadhaar Card</th>
                                    <th>IFSC Code</th>
                                    <th>Bank Account</th>
                                    <th>Full Name</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th style="width:100px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lists as $kyc)
                                <tr valign="middle">
                                    <td>{{ $kyc->id }}</td>
                                    <td>{{ $kyc->user_id }}</td>
                                    <td>{{ $kyc->pan_card }}</td>
                                    <td>{{ $kyc->aadhaar_card }}</td>
                                    <td>{{ $kyc->ifsc_code }}</td>
                                    <td>{{ $kyc->bank_ac_no }}</td>
                                    <td>{{ $kyc->full_name }}</td>
                                    <td>
                                        @if($kyc->status)
                                        <span class="badge badge-success">Verified</span>
                                        @else 
                                        <a href="{{ route('user.kyc.verify', ['id'=> $kyc->id]) }}" class="btn btn-sm btn-primary">Verify Details</a>
                                        @endif
                                    </td>
                                    <td>{{ $kyc->created_at->format('M j, Y') }}</td>
                                    <td style="width:100px" class="d-flex">
                                    <a href="{{ route('user.show', $kyc->user->id) }}" class="btn btn-sm btn-success mr-1"> <i class="fas fa-eye"></i> </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 