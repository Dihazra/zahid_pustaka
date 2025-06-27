<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        /* Warna dan Font Global */
        body {
            background-color:rgba(128, 128, 128, 0.3); /* putih gading */
            color: #333333;
            font-family: 'Segoe UI', sans-serif;
        }

        h1, h2, h3 {
            color: #001f3f; /* biru tua */
        }

        /* Navbar */
    .navbar {
    position: sticky;
    top: 0;
    z-index: 1030;
    background-color: rgba(255, 255, 255, 0.3);/* Biru Laut */
    color: #FFFFFF;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
}



        .navbar .nav-link,
        .navbar .navbar-brand {
            color:rgb(0, 0, 0) !important;
        }

        .navbar .nav-link:hover,
        .navbar .navbar-brand:hover {
            color: #B2C8A9 !important;
        }

        .navbar .btn-outline-primary {
            border-color: #B2C8A9;
            color: #B2C8A9;
        }

        .navbar .btn-outline-primary:hover {
            background-color: #B2C8A9;
            color: #001f3f;
        }

        /* Card Buku */
        .blur-container {
            background:  rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .book-card {
            transition: all 0.3s ease;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            border-radius: 1rem;
        }

        .book-card:hover {
            transform: scale(1.03);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .book-cover {
            height: 260px;
            object-fit: cover;
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
        }

        .card-body {
            text-align: center;
            background-color: #FFFAFA;
            border-radius: 1rem;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: bold;
            color: #001f3f;
        }

        .card-text {
            font-size: 0.95rem;
            color: #666;
        }

        /* Tombol CTA */
        .btn-primary {
            background-color: #007BFF;
            border-color: #007BFF;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-danger {
            background-color: #800000;
            border-color: #800000;
        }

        .btn-danger:hover {
            background-color: #660000;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #B2C8A9;
            border-color: #B2C8A9;
        }

        /* Footer */
        .end-page {
            background-color:#FFFAFA;
            color:rgb(0, 0, 0);
            padding: 40px 0;
            text-align: center;
        }

        .footer-social-icons a {
            color:rgb(0, 0, 0);
            margin: 0 10px;
            font-size: 20px;
            text-decoration: none;
        }

        .footer-social-icons a:hover {
            color: #B2C8A9;
        }

        .book-detail-cover {
        height: 600px;
        width: 100%;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">Libra</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
            <form class="d-flex me-3" action="{{ route('books.index') }}" method="GET">
                <div class="input-group">
                    <input class="form-control" name="search" type="search" placeholder="Cari Buku..." value="{{ request('search') }}">
                    <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i></button>
                </div>
            </form>
            <ul class="navbar-nav">
                @auth
                    @if(Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="/dashboard">Manage Books</a>
                        </li>
                    @endif
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">{{ Auth::user()->email }}</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="/logout" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-link text-decoration-none">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('my.loans') }}">Peminjaman Saya</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<main class="container my-5">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</main>

<div class="end-page">
    <div class="container">
        <p>Perpustakaan Digital Libra &copy; 2025</p>
        <div class="footer-social-icons">
            <a href="#"><i class="bi bi-facebook"></i></a>
            <a href="#"><i class="bi bi-twitter"></i></a>
            <a href="#"><i class="bi bi-instagram"></i></a>
            <a href="#"><i class="bi bi-linkedin"></i></a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
