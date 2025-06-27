<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Libra</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    {{-- Bootstrap & Icon --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background-color: rgba(255, 255, 255, 0.3); /* Putih gading */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-card {
            max-width: 420px;
            width: 100%;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
            padding: 30px;
        }

        .form-floating label {
            color: #555;
        }

        .btn-primary {
            background-color: #007BFF;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .login-title {
            font-weight: bold;
            color: #001f3f;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <h2 class="text-center login-title mb-4">Login User</h2>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="/login" method="POST">
            @csrf
            <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                <label for="floatingInput">Email address</label>
            </div>

            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                <label for="floatingPassword">Password</label>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">Login</button>
            </div>
        </form>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
