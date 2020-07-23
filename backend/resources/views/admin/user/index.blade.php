@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">User page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">User list</li>
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
                            <h3 class="card-title">User List</h3>
                           @can('user create') <a href="{{ route('user.create') }}" class="btn btn-primary">Create User</a>@endcan
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Wallet</th>
                                    <th>User Role</th>
                                    <th>Referral Count</th>
                                    <th style="width:150px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr valign="middle">
                                    <td>{{ $user->id }}</td>
                                    <td>
                                        @if($user->avatar)
                                        <img style="width:50px; height:50px;border-radius:50%;object-fit:cover;" src="{{ asset($user->avatar) }}" alt="User Avatar">
                                        @else
                                        <img style="width:50px; height:50px;border-radius:50%;object-fit:cover;" src="{{ asset('admin') }}/dist/img/user.png" alt="User Avatar">
                                        @endif
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td> @if($user->wallet){{ $user->wallet->balance }} @endif</td>
                                    <td>{{ $user->role->name }}</td>
                                    <td>{{ count($user->referrals) }}</td>
                                    <td style="width:150px" class="d-flex">
                                        @can('user edit')<a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-primary mr-1"> <i class="fas fa-edit"></i> </a> @endcan
                                        @can('user view')<a href="{{ route('user.show', $user->id) }}" class="btn btn-sm btn-success mr-1"> <i class="fas fa-eye"></i> </a> @endcan 
                                        @can('user delete')<form action="{{ route('user.destroy', $user->id) }}" method="post">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection