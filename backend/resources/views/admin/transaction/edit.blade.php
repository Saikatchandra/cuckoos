@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Transaction </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('transaction.index') }}">Transaction</a></li>
                    <li class="breadcrumb-item active">Edit</li>
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
                            <h3 class="card-title">Shipping List</h3>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <form action="{{ route('transaction.update', $transaction->id) }}" method="POST">
                            @csrf 
                            <div class="row">
                                <div class="col-6 offset-3">
                                    <div class="form-group">
                                        <label for="status">Transaction Status</label>
                                        <select name="status" id="status" class="form-control"> 
                                            <option value="2" @if($transaction->status == 2) selected @endif > Pending </option>
                                            <option value="1" @if($transaction->status == 1) selected @endif > Approve </option>
                                            <option value="0" @if($transaction->status == 0) selected @endif > Decline </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success"> Update </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection