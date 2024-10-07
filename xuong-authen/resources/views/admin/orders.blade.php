@extends('layouts.admin')

@section('title')
    Orders
@endsection

@section('content')
    <h1 class="text-center">Orders Admin</h1>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
@endsection
