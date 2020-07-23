@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">User Edit Page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User List</a></li>
                    <li class="breadcrumb-item active">Edit User</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">    
                            <h3 class="card-title">Edit User</h3>
                            @can('user index')<a href="{{ route('user.index') }}" class="btn btn-light text-dark">User list</a> @endcan
                        </div>
                    </div>
                    <form action="{{ route('user.update', $user->id) }}" method="post" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 offset-3">
                                    @include('includes.validation')
                                    <div class="form-group">
                                        <label for="userName">User Name</label>
                                        <input type="text" class="form-control" name="name" id="userName" placeholder="Enter name" value="{{ $user->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="userEmail">Email</label>
                                        <input type="email" class="form-control" name="email" id="userEmail" placeholder="Email" value="{{ $user->email }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="userPassword">Password <small>(Enter password if you want to update)</small></label>
                                        <input type="password" class="form-control" id="userPassword" name="password" placeholder="Password" value="{{ $user->userPassword }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="userAvatar">User Avatar <small>(Choose Image if you want to update)</small></label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="image" id="userAvatar">
                                                <label class="custom-file-label" for="userAvatar">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="userRole">Select User Role</label>
                                        <select name="role" id="userRole" class="form-control">
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}" @if($user->role->name == $role->name) selected @endif  @if($role->id == 1 || $role->id == 2 || $role->id == 3 || $role->id == 4) disabled @endif>{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Update User</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection