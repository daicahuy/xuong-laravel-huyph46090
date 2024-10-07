<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
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
    <div class="container-fuild px-4">
        <h1 class="text-center">List Employees</h1>
        @if (session()->has('success') && session('success'))
            <div class="alert alert-success">Thao tac thanh cong</div>
        @endif
        @if (session()->has('success') && !session('success'))
            <div class="alert alert-danger">Thao tac that bai</div>
        @endif
        <div class="text-end mb-3">
            <a href="{{ route('employees.create') }}" class="btn btn-success">Create</a>
        </div>
        <table class="table">
            <theaed>
                <tr>
                    <th class="text-capitalize">ID</th>
                    <th class="text-capitalize">first name</th>
                    <th class="text-capitalize">last name</th>
                    <th class="text-capitalize">profile picture</th>
                    <th class="text-capitalize">email</th>
                    <th class="text-capitalize">phone</th>
                    <th class="text-capitalize">date of birth</th>
                    <th class="text-capitalize">hire date</th>
                    <th class="text-capitalize">salary</th>
                    <th class="text-capitalize">is active</th>
                    <th class="text-capitalize">department id</th>
                    <th class="text-capitalize">manager id</th>
                    <th class="text-capitalize">address</th>
                    <th class="text-capitalize">action</th>
                </tr>
            </theaed>
            <tbody>
                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee->id }}</td>
                        <td>{{ $employee->first_name }}</td>
                        <td>{{ $employee->last_name }}</td>
                        <td>
                            <img src="data:image;base64,{{ $employee->profile_picture }}" alt="" width="50px">
                        </td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->phone }}</td>
                        <td>{{ $employee->date_of_birth }}</td>
                        <td>{{ $employee->hire_date }}</td>
                        <td>{{ $employee->salary }}</td>
                        <td>
                            @if ($employee->is_active == 1)
                                <span class="badge bg-primary">Yes</span>
                            @else
                                <span class="badge bg-danger">No</span>
                            @endif
                        </td>
                        <td>{{ $employee->department_id }}</td>
                        <td>{{ $employee->manager_id }}</td>
                        <td>{{ $employee->address }}</td>
                        <td style="width: 1px; white-space: nowrap;">
                            <a href="{{ route('employees.show', [$employee]) }}" class="btn btn-primary">Show</a>
                            <a href="{{ route('employees.edit', [$employee]) }}" class="btn btn-warning my-1">Edit</a>
                            <form action="{{ route('employees.destroy', [$employee]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Ban co chac muon xoa mem khong ?')">Soft delete</button>
                            </form>
                            <form action="{{ route('employees.forceDelete', [$employee]) }}" method="POST"
                                class="mt-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Ban co chac muon xoa bay mau luon khong ?')">Force
                                    delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $employees->links() }}
    </div>

</body>

</html>
