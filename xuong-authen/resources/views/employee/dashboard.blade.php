@extends('layouts.employee')

@section('title')
    Dashboard
@endsection

@section('content')
    <h1 class="text-center">Dashboard Employee</h1>
    @if(session()->has('message'))
        <div class="alert alert-{{ session('message')['type'] }}">{{ session('message')['message'] }}</div>
    @endif
    <h4>Xin chao {{ \Illuminate\Support\Facades\Auth::user()->name }} den voi website !</h4>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
@endsection
