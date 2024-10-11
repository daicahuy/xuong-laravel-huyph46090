@extends('master')

@section('content')
    <div class="container">
        <h2 class="mb-4 text-center mt-2">List Students</h2>
        @if (session()->has('message') && session('message'))
            <div class="alert alert-{{ session('message')['type'] }}">{{ session('message')['content'] }}</div>
        @endif
        <div class="row">
            <div class="col-2">
                <a href="{{ route('students.create') }}" class="btn btn-success w-100">Create New Student</a>
            </div>
            <div class="col-5 offset-5">
                <form class="d-flex my-2 my-lg-0 w-100">
                    <input
                        class="form-control me-sm-2"
                        type="text"
                        placeholder="Search for student name, classroom name"
                        name="keyword"
                        value="{{ $keyword }}"
                    />
                    <button
                        class="btn btn-outline-success my-2 my-sm-0"
                        type="submit"
                    >
                        Search
                    </button>
                </form>
            </div>
        </div>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Passport</th>
                    <th>Classroom Name</th>
                    <th>Subject Name</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->passport->passport_number }}</td>
                        <td>{{ $student->classroom->name }}</td>
                        <td>
                            @foreach ($student->subjects as $subject)
                                {{ $subject->name }}, 
                            @endforeach
                        </td>
                        <td style="width: 1px;">
                            <div class="d-flex">
                                <a href="{{ route('students.show', $student) }}" class="btn btn-info">Detail</a>
                                <a href="{{ route('students.edit', $student) }}" class="btn btn-warning mx-1">Edit</a>
                                <form action="{{ route('students.destroy', $student) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Do you want delete this student ?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                @if ($students->isEmpty())
                    <tr><td colspan="7" class="text-center">No student record</td></tr>
                @endif
            </tbody>
        </table>
        {{ $students->links() }}
    </div>
@endsection