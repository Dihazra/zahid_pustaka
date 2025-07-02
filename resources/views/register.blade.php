<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width: 500px;">
    <div class="card shadow">
        <div class="card-body">
            <h3 class="mb-4 text-center">Form Registrasi</h3>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label>No. Telepon</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                    @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <div class="input-group">
                        <input type="password" id="password" name="password" class="form-control" required>
                        <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">👁️</button>
                    </div>
                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label>Konfirmasi Password</label>
                    <div class="input-group">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                        <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordConfirm()">👁️</button>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Daftar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JS Bootstrap & toggle password -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function togglePassword() {
    const field = document.getElementById("password");
    field.type = field.type === "password" ? "text" : "password";
}

function togglePasswordConfirm() {
    const field = document.getElementById("password_confirmation");
    field.type = field.type === "password" ? "text" : "password";
}
</script>

</body>
</html>
