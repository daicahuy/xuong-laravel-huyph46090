@extends('master')

@section('content')
    <div class="container">
        <h2 class="text-center">Create Student</h2>
        @if (session()->has('message') && session('message'))
            <div class="alert alert-{{ session('message')['type'] }}">{{ session('message')['content'] }}</div>
        @endif
        <form action="{{ route('students.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-7">
                    <div class="mb-3">
                        <label for="" class="form-label">Name</label>
                        <input type="text" name="student[name]" class="form-control @error('student.name') is-invalid  @enderror" value="{{ old('student.name') }}">
                        <div class="invalid-feedback">@error('student.name') {{ $message }}  @enderror</div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Email</label>
                        <input type="email" name="student[email]" class="form-control @error('student.email') is-invalid  @enderror" value="{{ old('student.email') }}">
                        <div class="invalid-feedback">@error('student.email') {{ $message }}  @enderror</div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Passport</label>
                        <input type="text" name="passport[passport_number]" class="form-control @error('passport.passport_number') is-invalid  @enderror" value="{{ old('passport.passport_number') }}">
                        <div class="invalid-feedback">@error('passport.passport_number') {{ $message }}  @enderror</div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Issued Date</label>
                        <input type="date" name="passport[issued_date]" class="form-control @error('passport.issued_date') is-invalid  @enderror" value="{{ old('passport.issued_date') }}">
                        <div class="invalid-feedback">@error('passport.issued_date') {{ $message }}  @enderror</div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Expiry Date</label>
                        <input type="date" name="passport[expiry_date]" class="form-control @error('passport.expiry_date') is-invalid  @enderror" value="{{ old('passport.expiry_date') }}">
                        <div class="invalid-feedback">@error('passport.expiry_date') {{ $message }}  @enderror</div>
                    </div>
                </div>
                <div class="col-4 offset-1">
                    <div class="mb-3">
                        <label for="" class="form-label">Classroom</label>
                        <select class="form-select @error('student.classroom_id') is-invalid  @enderror" value="{{ old('student.name') }}" name="student[classroom_id]">
                            <option @if(!old('student.classroom_id')) selected @endif disabled>--Select Classroom--</option>
                            @foreach (App\Models\Classroom::all() as $classroom)
                                <option value="{{ $classroom->id }}" @selected(old('student.classroom_id') == $classroom->id)>{{ $classroom->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">@error('student.classroom_id') {{ $message }}  @enderror</div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Subjects</label>
                        <select class="form-select @error('subjects') is-invalid  @enderror @error('subjects.*') is-invalid  @enderror" value="{{ old('student.name') }}" multiple aria-label="multiple select" name="subjects[]">
                            <option @if(!old('subjects')) selected @endif disabled>--Select Subjects--</option>
                            @foreach (App\Models\Subject::all() as $subject)
                                <option value="{{ $subject->id }}" @if(old('subjects')) @selected(in_array($subject->id, old('subjects'))) @endif>{{ $subject->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">@error('subjects') {{ $message }}  @enderror @error('subjects.*') {{ $message }}  @enderror</div>
                    </div>
                </div>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-success">Create</button>
            </div>
        </form>
    </div>
@endsection