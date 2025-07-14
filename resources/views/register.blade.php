<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - Libra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #0D1117;
            color: #FFFFFF;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .auth-container {
            background-color: #161B22;
            padding: 2rem 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 0 15px rgba(0,0,0,0.4);
            width: 100%;
            max-width: 600px;
            text-align: center;
        }
        .auth-container h2 {
            margin-bottom: 1.2rem;
            color: #FFD700;
        }
        .auth-container input[type="text"],
        .auth-container input[type="email"],
        .auth-container input[type="password"] {
            width: 100%;
            padding: 0.8rem;
            margin-bottom: 1.2rem;
            border: none;
            border-radius: 0.5rem;
            background-color: #0D1117;
            color: #FFFFFF;
            border: 1px solid #30363D;
            transition: border-color 0.3s;
        }
        .auth-container input:focus {
            outline: none;
            border-color: #FFD700;
        }
        .auth-container .input-group .form-control {
            background-color: #0D1117;
            color: #FFFFFF;
            border: 1px solid #30363D;
        }
        .auth-container .input-group .form-control:focus {
            border-color: #FFD700;
            box-shadow: none;
        }
        .auth-container .input-group-text {
            background-color: #0D1117;
            border: 1px solid #30363D;
            color: #FFD700;
            cursor: pointer;
        }
        .auth-container button[type="submit"] {
            width: 100%;
            padding: 0.9rem;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 0.5rem;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .auth-container button[type="submit"]:hover {
            background-color: #0056b3;
        }
        .auth-container small.text-danger {
            display: block;
            margin-top: -0.8rem;
            margin-bottom: 0.8rem;
            text-align: left;
        }
        .auth-link {
            margin-bottom: 1rem;
            font-size: 0.9rem;
            color: #CCCCCC;
        }
        .auth-link a {
            color: #FFD700;
            text-decoration: none;
        }
        .auth-link a:hover {
            text-decoration: underline;
        }
        .input-group {
            align-items: center;
        }
        .input-group .form-control {
            background-color: #0D1117;
            color: #ffffff;
            border: 1px solid #30363D;
            border-radius: 0.5rem;
        }
        .input-group .input-group-text {
            background-color: #0D1117;
            color: #FFD700;
            border: 1px solid #30363D;
            border-left: none;
            border-radius: 0 0.5rem 0.5rem 0;
            cursor: pointer;
            display: flex;
            align-items: center;
            padding: 0 0.75rem;
        }
        .input-group .form-control:focus {
            border-color: #FFD700;
            box-shadow: none;
        }
        .input-group .show-btn {
            background: #FFD700;
            color: #161B22;
            border: none;
            border-radius: 0 0.5rem 0.5rem 0;
            padding: 0 0.75rem;
            font-size: 0.9rem;
            cursor: pointer;
            height: 100%;
        }
        .input-group .show-btn:active {
            background: #FFC107;
        }
    </style>
</head>
<body>

    <div class="auth-container">
        <h2>Register</h2>
        <div class="auth-link">Sudah punya akun? <a href="/login">Login di sini</a></div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <input type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror

            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror

            <input type="text" name="phone" placeholder="No. Telepon" value="{{ old('phone') }}">
            @error('phone') <small class="text-danger">{{ $message }}</small> @enderror

            <div class="input-group ">
                <input type="password" id="password" name="password" placeholder="Password" class="form-control" required>
                
            </div>
            @error('password') <small class="text-danger">{{ $message }}</small> @enderror

            <div class="input-group mb-3">
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password" class="form-control" required>
            </div>

            <button type="submit">Daftar</button>
        </form>
    </div>



</body>
</html>
