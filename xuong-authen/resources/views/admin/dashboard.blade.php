@extends('layouts.admin')

@section('title')
    Dashboard
@endsection

@section('content')
    <h1 class="text-center">Dashboard Admin</h1>
    <h4>Xin chao {{ \Illuminate\Support\Facades\Auth::user()->name }} den voi website !</h4>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
@endsection
