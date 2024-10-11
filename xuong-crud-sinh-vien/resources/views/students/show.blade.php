@extends('master')

@section('content')
    <div class="container">
        <h2 class="text-center">Detail Student: {{ $student->name }}</h2>
        <div class="row">
            <div class="col-7">
                <div class="mb-3">
                    <label for="" class="form-label">Name</label>
                    <input type="text" class="form-control" value="{{ $student->name }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Email</label>
                    <input type="email" class="form-control" value="{{ $student->email }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Passport</label>
                    <input type="text" class="form-control" value="{{ $student->passport->passport_number }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Issued Date</label>
                    <input type="date" class="form-control" value="{{ $student->passport->issued_date }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Expiry Date</label>
                    <input type="date" class="form-control" value="{{ $student->passport->expiry_date }}" disabled>
                </div>
            </div>
            <div class="col-4 offset-1 mt-4">
                <div class="mb-3">
                    <label for="" class="form-label">Classroom:</label>
                    <br>
                    <span class="badge bg-danger">{{ $student->classroom->name }}</span>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Subjects:</label>
                    <br>
                    @foreach ($student->subjects as $subject)
                        <span class="badge bg-primary">{{ $subject->name }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection