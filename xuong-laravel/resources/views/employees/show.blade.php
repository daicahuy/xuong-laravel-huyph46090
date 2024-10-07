<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta disabled name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Xuong - Buoi 3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="container">
        <h1 class="text-center mb-5">Show Employee {{ $employee->first_name }} {{ $employee->last_name }}</h1>
        <form action="#!" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <img src="data:image;base64,{{ $employee->profile_picture }}" alt="" width="100px">
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="" class="form-label">First Name</label>
                        <input type="text" class="form-control" value="{{ $employee->first_name }}" disabled name="first_name">
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="" class="form-label">Last Name</label>
                        <input type="text" class="form-control" value="{{ $employee->last_name }}" disabled name="last_name">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="" class="form-label">Email</label>
                        <input type="email" class="form-control" value="{{ $employee->email }}" disabled name="email">
                    </div>
                </div>
                <div class="col-6">
                    <label for="" class="form-label">Image</label>
                    <input type="file" class="form-control" disabled name="profile_picture">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-6">
                    <div>
                        <label for="" class="form-label">Phone</label>
                        <input type="text" class="form-control" value="{{ $employee->phone }}" disabled name="phone">
                    </div>
                </div>
                <div class="col-6">
                    <div>
                        <label for="" class="form-label">Birthday</label>
                        <input type="date" class="form-control" value="{{ $employee->date_of_birth }}"
                            disabled name="date_of_birth">
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-5">
                    <label for="" class="form-label">Hire date</label>
                    <input type="datetime-local" class="form-control" value="{{ $employee->hire_date }}" disabled name="hire_date">
                </div>
                <div class="col-7">
                    <label for="" class="form-label">Salary</label>
                    <input type="number" class="form-control" value="{{ $employee->salary }}" disabled name="salary"
                        step="0.01">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-5">
                    <label for="" class="form-label">Department id</label>
                    <input type="text" class="form-control" value="{{ $employee->department_id }}" disabled name="department_id">
                </div>
                <div class="col-5">
                    <label for="" class="form-label">Manager id</label>
                    <input type="text" class="form-control" value="{{ $employee->manager_id }}" disabled name="manager_id">
                </div>
                <div class="col-2">
                    <label for="" class="form-label d-block">Active</label>
                    <input type="checkbox" class="form-check-input" @checked($employee->is_active) disabled name="is_active"
                        value="1">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-12">
                    <label for="" class="form-label">Address</label>
                    <input type="text" class="form-control" value="{{ $employee->address }}" disabled name="address">
                </div>
            </div>
            <div class="mt-4 d-flex justify-content-between">
                <a class="btn btn-secondary me-2" href="{{ route('employees.index') }}">Back</a>
            </div>
        </form>
    </div>

</body>

</html>
