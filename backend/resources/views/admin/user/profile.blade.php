@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">My profile</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">My profile</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <form action="{{ route('user.profile.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            @include('includes.validation')
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="userName">User Name</label>
                                        <input type="text" class="form-control" name="name" id="userName" placeholder="Enter name" value="{{ $user->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="userPhone">Phone</label>
                                        <input type="text" class="form-control" name="phone" id="userPhone" placeholder="Phone" value="{{ $user->phone }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="userEmail">Email</label>
                                        <input type="email" class="form-control" name="email" id="userEmail" placeholder="Email" value="{{ $user->email }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="userPassword">Password <small>(Enter password if you want to update)</small></label>
                                        <input type="password" class="form-control" id="userPassword" name="password" placeholder="Password">
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
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="userPhone">Address</label>
                                        <textarea name="address"class="form-control" rows="1" placeholder="Address">{{ $user->address }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="userFacebook">Facebook</label>
                                        <input type="text" class="form-control" name="facebook" id="userFacebook" placeholder="Facebook" value="{{ $user->facebook }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="userSkype">Skype</label>
                                        <input type="text" class="form-control" name="skype" id="userSkype" placeholder="Skype" value="{{ $user->skype }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="userEmail">Description</label>
                                        <textarea name="description" class="form-control" rows="5" placeholder="Write about your self">{{ $user->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-4">
                <div class="card card-widget widget-user">
                    <div class="widget-user-header bg-info">
                        <h3 class="widget-user-username">{{ $user->name }}</h3>
                        <h5 class="widget-user-desc">{{ $user->email}}</h5>
                    </div>
                    <div class="widget-user-image">
                        @if($user->avatar)
                        <img class="" style="width:90px; height:90px;border-radius:50%;object-fit:cover;" src="{{ asset($user->avatar) }}" alt="User Avatar">
                        @else
                        <img class="img-circle elevation-2" src="{{ asset('admin') }}/dist/img/user.png" alt="User Avatar">
                        @endif
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">About Me</h3>
                    </div>
                    <div class="card-body">
                        @if($user->referral_link)
                        <strong><i class="fas fa-paperclip mr-1"></i> Referral Link</strong>
                        <p class="text-muted">
                            {{ $user->referral_link }}
                        </p>
                        <hr>
                        @endif
                        @if($user->description)
                        <strong><i class="far fa-address-card mr-1"></i> About Me</strong>
                        <p class="text-muted">
                            {{ $user->description }}
                        </p>
                        <hr>
                        @endif
                        @if($user->phone)
                        <strong><i class="fas fa-phone mr-1"></i> Phone Number</strong>
                        <p class="text-muted">
                            {{ $user->phone }}
                        </p>
                        <hr>
                        @endif
                        @if($user->address)
                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                        <p class="text-muted">{{ $user->address }}</p>
                        <hr>
                        @endif
                        @if($user->dob)
                        <strong><i class="fas fa-pencil-alt mr-1"></i> Date of Birth</strong>
                        <p class="text-muted"> {{ $user->dob }} </p>
                        <hr>
                        @endif
                        <strong><i class="fas fa-network-wired mr-1"></i> Social </strong>
                        @if($user->facebook)
                        <div>
                             Facebook - 
                            <a href="{{ $user->facebook }}" target="_blank">Profile link</a> 
                        </div>
                        @endif
                        @if($user->skype)
                        <div>
                           Skype - 
                            <a href="{{ $user->skype }}">{{ $user->skype }}</a> 
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12 mt-5">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th> ID </th>
                            <th> Amount </th>
                            <th> Type </th>
                            <th> Date </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($transactions->count())
                        @foreach($transactions as $transaction)
                        <tr>
                            <td> {{ $transaction->id }} </td>
                            <td> {{ $transaction->amount }} </td>
                            <td>
                                @if($transaction->type)
                                    <div class="btn btn-success">Deposit</div>
                                @else 
                                    <div class="btn btn-danger">Expense</div>
                                @endif
                            </td>
                            <td> {{ $transaction->created_at->format('d M, Y') }} </td>
                        </tr>
                        @endforeach
                        @else 
                            <tr>
                                <td colspan="4"> <h5 class="py-4 text-center">No transaction found</h5></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection