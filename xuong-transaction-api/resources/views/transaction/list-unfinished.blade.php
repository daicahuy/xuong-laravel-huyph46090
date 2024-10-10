@extends('master')

@section('content')
    <h2 class="text-center">Transaction Unfinished</h2>
    <a href="{{ route('transaction.index') }}" class="btn btn-primary">Back to list transaction</a>
    <div class="mt-4">

        @if (session()->has('transaction'))
            <div class="row">
                <div class="col-4">
                    <div class="border border-1 p-2">
                        <div class="row mb-2">
                            <div class="col-6">ID:</div>
                            <div class="col-6">{{ session('transaction.transaction_id') }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">Amount:</div>
                            <div class="col-6">{{ session('transaction.amount') }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">Receiver Account:</div>
                            <div class="col-6">{{ session('transaction.receiver_account') }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">Status:</div>
                            <div class="col-6">
                                <span class="badge bg-warning">{{ session('transaction.status') }}</span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">Step:</div>
                            <div class="col-6">
                                {{ session('transaction.step') }}
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-6">
                                <form action="{{ route('transaction.cancel') }}" method="POST" class="w-100">
                                    @csrf
                                    <button type="submit" class="btn btn-danger w-100">Cancel Transaction</button>
                                </form>
                            </div>
                            <div class="col-6">
                                <form action="{{ route('transaction.continue') }}" method="POST" class="w-100">
                                    @csrf
                                    <button type="submit" class="btn btn-success w-100">Continue Transaction</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            No transaction unfinished
        @endif
    </div>
@endsection
