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
/* Global Style */
body {
    background-color: #0D1117; /* Warna latar belakang dark */
    color: #FFFFFF;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

/* Container Box */
.auth-container {
    background-color: #161B22;
    padding: 2rem 2.5rem;
    border-radius: 1rem;
    box-shadow: 0 0 15px rgba(0,0,0,0.4);
    width: 100%;
    max-width: 400px;
    text-align: center;
}

/* Heading */
.auth-container h2 {
    margin-bottom: 1.5rem;
    color: #FFD700; /* Emas */
}

/* Input Fields */
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

/* Button */
.auth-container button {
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

.auth-container button:hover {
    background-color: #0056b3;
}

/* Link */
.auth-container .auth-link {
    margin-top: 1rem;
    color: #CCCCCC;
    font-size: 0.9rem;
}

.auth-container .auth-link a {
    color: #FFD700;
    text-decoration: none;
}

.auth-container .auth-link a:hover {
    text-decoration: underline;
}

.btn-view-lg {
    position: absolute;
    bottom: 15px;
    left: 50%;
    transform: translateX(-50%);
    background-color: rgba(255, 255, 255, 0.9);
    color: #000;
    padding: 6px 20px;
    border-radius: 14px;
    font-weight: 500;
    font-size: 0.9rem;
    z-index: 3;
    text-decoration: none;
    border: none;
    transition: 0.2s ease-in-out;
}
.btn-view-lg:hover {
    background-color: #FFA500;
}
    </style>
    

</head>
<body>

    <div class="auth-container">
        <h2>Login</h2>
        <p class="auth-link">Don't have an account? <a href="/register">Create your account</a></p>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="/login" method="POST">
            @csrf
            <input type="email" name="email" placeholder="Username or Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <div class="form-check mb-3 text-start">
                <input class="form-check-input" type="checkbox" value="" id="rememberMe">
                <label class="form-check-label" for="rememberMe">
                    Remember me
                </label>
                <a href="#" class="float-end" style="font-size: 0.9em; color: #FFD700;">Forgot password?</a>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>