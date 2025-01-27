@extends('layouts.auth')

@section('content')
<div class="card-body login-card-body">
    <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
    
    @include('includes.validation')
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="input-group mb-3">
            <input id="email" placeholder="Email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Request new password</button>
            </div>
        </div>
    </form>

    <p class="mt-3 mb-1">
        <a href="{{ route('login') }}">Login</a>
    </p>
    <p class="mb-0">
        <a href="{{ route('register') }}" class="text-center">Register a new membership</a>
    </p>
</div>
@endsection
