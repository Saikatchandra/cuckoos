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
            <div class="col-6">
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
                        <div class="row">
                            {{-- <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">3,200</h5>
                                    <span class="description-text">SALES</span>
                                </div>
                            </div>
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">13,000</h5>
                                    <span class="description-text">FOLLOWERS</span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">35</h5>
                                    <span class="description-text">PRODUCTS</span>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">About user</h3>
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
                        @if($user->phone)
                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                        <p class="text-muted">{{ $user->address }}</p>
                        <hr>
                        @endif
                        @if($user->phone)
                        <strong><i class="fas fa-pencil-alt mr-1"></i> Date of Birth</strong>
                        <p class="text-muted"> {{ $user->dob }} </p>
                        <hr>
                        @endif
                        <strong><i class="fas fa-network-wired mr-1"></i> Social </strong>
                        <p class="text-muted">
                            @if($user->facebook) <a href="{{ $user->facebook }}"></a><i class="fab fa-facebook"></i> @endif
                            @if($user->skype) <a href="{{ $user->skype }}"></a>{{ $user->skype }} @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @if($kyc)
        <div class="row">
            <div class="col-12">
                <div class="card card-light">
                    <div class="card-header">User KYC Info</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <table class="table table-bordered">
                                    <tr>
                                        <th> Full Name </th>
                                        <td> {{ $kyc->full_name }} </td>
                                    </tr>
                                    <tr>
                                        <th> Pen Card </th>
                                        <td> {{ $kyc->pan_card }} </td>
                                    </tr>
                                    <tr>
                                        <th> Aadhaar Card </th>
                                        <td> {{ $kyc->aadhaar_card }} </td>
                                    </tr>
                                    <tr>
                                        <th> IFSC code </th>
                                        <td> {{ $kyc->ifsc_code }} </td>
                                    </tr>
                                    <tr>
                                        <th> Bank AC No </th>
                                        <td> {{ $kyc->bank_ac_no }} </td>
                                    </tr>
                                    <tr>
                                        <th> Status </th>
                                        <td>
                                            @if($kyc->status)
                                            <span class="badge badge-success">Verified</span>
                                            @else 
                                            <a href="{{ route('user.kyc.verify', ['id'=> $kyc->id]) }}" class="btn btn-sm btn-primary">Verify Details</a>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-8">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="card">
                                            <figure class="figure">
                                                <img src="{{ asset($kyc->pan_card_image) }}" class="figure-img img-fluid rounded">
                                                <figcaption class="figure-caption text-center"> PAN Card Image </figcaption>
                                            </figure>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="card">
                                            <figure class="figure">
                                                <img src="{{ asset($kyc->aadhaar_card_image) }}" class="figure-img img-fluid rounded">
                                                <figcaption class="figure-caption text-center"> Aadhaar Card Image </figcaption>
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
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