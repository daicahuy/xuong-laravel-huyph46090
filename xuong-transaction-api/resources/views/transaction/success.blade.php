@extends('master')

@section('content')
    <h2 class="text-center bg-success py-2 text-white">Transaction success</h2>
    <div class="mt-4">
        <a href="{{ route('transaction.index') }}" class="btn btn-secondary me-2">Back To Home</a>
    </div>
@endsection
