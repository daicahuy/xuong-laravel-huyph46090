@extends('layouts.employee')

@section('title')
    Orders
@endsection

@section('content')
    <h1 class="text-center">Orders Employee</h1>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
@endsection
