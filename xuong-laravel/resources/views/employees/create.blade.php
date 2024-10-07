<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta value="{{ old('viewport') }}" name="viewport"
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
        <h1 class="text-center mb-5">Create Employee</h1>
        @if (session()->has('success') && !session('success'))
            <div class="alert alert danger">Them moi that bai</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="" class="form-label">First Name</label>
                        <input type="text" class="form-control" value="{{ old('first_name') }}" name="first_name">
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="" class="form-label">Last Name</label>
                        <input type="text" class="form-control" value="{{ old('last_name') }}" name="last_name">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="" class="form-label">Email</label>
                        <input type="email" class="form-control" value="{{ old('email') }}" name="email">
                    </div>
                </div>
                <div class="col-6">
                    <label for="" class="form-label">Image</label>
                    <input type="file" class="form-control" name="profile_picture">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-6">
                    <div>
                        <label for="" class="form-label">Phone</label>
                        <input type="text" class="form-control" value="{{ old('phone') }}" name="phone">
                    </div>
                </div>
                <div class="col-6">
                    <div>
                        <label for="" class="form-label">Birthday</label>
                        <input type="date" class="form-control" value="{{ old('date_of_birth') }}"
                            name="date_of_birth">
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-5">
                    <label for="" class="form-label">Hire date</label>
                    <input type="datetime-local" class="form-control" value="{{ old('hire_date') }}" name="hire_date">
                </div>
                <div class="col-7">
                    <label for="" class="form-label">Salary</label>
                    <input type="number" class="form-control" value="{{ old('salary') }}" name="salary"
                        step="0.01">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-5">
                    <label for="" class="form-label">Department id</label>
                    <input type="text" class="form-control" value="{{ old('department_id') }}" name="department_id">
                </div>
                <div class="col-5">
                    <label for="" class="form-label">Manager id</label>
                    <input type="text" class="form-control" value="{{ old('manager_id') }}" name="manager_id">
                </div>
                <div class="col-2">
                    <label for="" class="form-label d-block">Active</label>
                    <input type="checkbox" class="form-check-input" @checked(old('is_active')) name="is_active"
                        value="1">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-12">
                    <label for="" class="form-label">Address</label>
                    <input type="text" class="form-control" value="{{ old('address') }}" name="address">
                </div>
            </div>
            <div class="mt-4 d-flex justify-content-between">
                <a class="btn btn-secondary me-2" href="{{ route('employees.index') }}">Back</a>
                <button type="submit" class="btn btn-success">Create</button>
            </div>
        </form>
    </div>

</body>

</html>
