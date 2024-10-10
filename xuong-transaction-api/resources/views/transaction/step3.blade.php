@extends('master')

@section('content')
    <h2 class="text-center">Step 3: OTP</h2>
    @if (session()->has('message') && session('message'))
        <div class="alert alert-{{ session('message')['type'] }}">{{ session('message')['content'] }}</div>
    @endif
    <form action="{{ route('transaction.handleStep3') }}" method="POST">
        @csrf
        <div class="mb-2">
            <label for="" class="form-label">OTP</label>
            <input type="text" name="otp" class="form-control">
        </div>
        <div class="mt-4">
            <a href="{{ route('transaction.step2') }}" class="btn btn-secondary me-2">Back To Step 2</a>
            <button type="submit" class="btn btn-success">Confirm</button>
        </div>
    </form>
@endsection
