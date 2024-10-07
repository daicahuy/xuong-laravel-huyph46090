<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <h1 class="mt-4 mb-3">Reset Password</h1>
    @if($errors->any())
        <div class="alert alert-warning">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('handleResetPassword', $token) }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="mb-3">
            <label for="" class="form-label">Email</label>
            <input type="email" name="email_disabled" class="form-control" value="{{ $email }}" disabled>
            <input type="hidden" name="email" value="{{ $email }}">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">New Password</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Confirm New Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>
        <div class="mt-5">
            <button type="submit" class="btn btn-success">Save</button>
        </div>
    </form>
</div>
</body>
</html>
