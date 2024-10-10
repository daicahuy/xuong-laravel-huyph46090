@extends('master')

@section('content')
    <h2 class="text-center">Step 1: Fill In Information</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('transaction.handleStep1') }}" method="POST">
        @csrf
        <div class="mb-2">
            <div class="row">
                <div class="col-6">
                    <label for="" class="form-label">Amount</label>
                    <input type="number" name="amount" class="form-control" value="{{ session('transaction.amount') }}">
                </div>
                <div class="col-6">
                    <label for="" class="form-label">Receiver Account</label>
                    <input type="text" name="receiver_account" class="form-control" value="{{ session('transaction.receiver_account') }}">
                </div>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('transaction.index') }}" class="btn btn-secondary me-2">Back to home</a>
            <button type="submit" class="btn btn-success">Continue</button>
        </div>
    </form>
@endsection
