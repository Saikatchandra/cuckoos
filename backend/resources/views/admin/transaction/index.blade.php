@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Transaction page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Transaction list</li>
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
                            <h3 class="card-title">Transaction List</h3>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th> ID </th>
                                    <th> Wallet ID </th>
                                    <th> Amount </th>
                                    <th> Type </th>
                                    <th> Status </th>
                                    <th> Date </th>
                                    <th style="width:150px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($transactions->count() > 0)
                                    @foreach($transactions as $transaction)
                                    <tr valign="middle">
                                        <td>{{ $transaction->id }}</td>
                                        <td>{{ $transaction->wallet_id }}</td>
                                        <td>{{ $transaction->amount }}</td>
                                        <td>
                                            @if($transaction->type == 1)
                                                <div class="btn btn-success">Deposit</div>
                                            @else Decline
                                                <div class="btn btn-danger"> Expense </div>
                                            @endif
                                        </td>
                                        <td>
                                            @if($transaction->status == 1)
                                                <div class="btn btn-success">Approved</div>
                                            @elseif($transaction->status == 2)
                                                <div class="btn btn-warning"> Pending </div>
                                            @else 
                                                <div class="btn btn-danger"> Decline </div>
                                            @endif
                                        </td>
                                        <td>{{ $transaction->created_at->format('M d, Y') }}</td>
                                        <td style="width:150px" class="d-flex">
                                            @can('transaction edit') <a href="{{ route('transaction.edit', $transaction->id) }}" class="btn btn-sm btn-primary mr-1"> <i class="fas fa-edit"></i> </a> @endcan
                                            {{-- <form action="{{ route('transaction.destroy', $transaction->id) }}" method="post">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form> --}}
                                        </td>
                                    </tr>
                                    @endforeach
                                @else 
                                    <tr>
                                        <td colspan="8">
                                            <h4 class="pt-4 pb-4 text-center mb-0">No Transaction Found</h4>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{ $transactions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection