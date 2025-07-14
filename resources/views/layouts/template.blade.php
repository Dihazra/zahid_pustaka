<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Perpustakaan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <style>
        /* Warna dan Font Global */
        body {
            background-color:rgba(128, 128, 128, 0.3); /* putih gading */
            color: #333333;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            height: 100%;
            margin: 0;
            padding: 0;         
        }

        main {
        flex: 1;
}


        h1, h2, h3 {
            color: #001f3f; /* biru tua */
        }

        /* Navbar */
    .navbar {
    position: sticky;
    top: 0;
    z-index: 1030;
    background-color: #001f3f;
    color: #FFFFFF;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
}



        .navbar .nav-link,
        .navbar .navbar-brand {
            color:rgb(255, 255, 255) !important;;
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

        .nav-link svg {
            transition: color 0.2s ease;
        }

        .nav-link:hover svg {
        color: #B2C8A9;
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
        <a class="navbar-brand fw-bold" style="font-size:24px" href="/">Libra</a>
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
            <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
            </svg>
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
                        <a class="nav-link" href="{{ route('my.loans') }}" title="Peminjaman Saya"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
  <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
</svg></a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}" title="Login"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
            <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
            </svg></a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<main class="container py-4">
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
    <div class="container py-4">
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
