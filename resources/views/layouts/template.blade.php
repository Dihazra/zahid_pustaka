<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .book-card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
            cursor: pointer;
            margin-bottom: 20px;
        }
        .book-card:hover {
            transform: translateY(-5px);
        }
        .book-cover {
            height: 300px; /* Adjust as needed */
            object-fit: cover;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        .card-body {
            text-align: center;
        }
        .card-title {
            font-size: 1.1rem;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .card-text {
            color: #6c757d;
        }
        .navbar-brand-custom {
            font-weight: bold;
            font-size: 1.5rem;
        }
        .badge-custom {
            font-size: 0.75em;
            vertical-align: top;
            margin-left: 2px;
        }
         .end-page {
            background-color: #d3d3d3 ;
            color: #000;
            padding: 40px 0;
            text-align: center;
        }

        .end-page-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-social-icons a {
            color: #000;
            margin: 0 10px;
            font-size: 20px;
            text-decoration: none;
        }

        .footer {
            background-color: #d3d3d3 ;
            color: #aaa;
            padding: 20px;
            text-align: center;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand navbar-brand-custom" href="/">Libra</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            </ul>
            <form class="d-flex me-3" role="search">
                <div class="input-group">
                    <input class="form-control" type="search" placeholder="Cari Buku" aria-label="Search">
                    <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
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
@else
  <li class="nav-item">
    <a class="nav-link" href="{{ route('login') }}">Login</a>
  </li>
@endauth

                <li class="nav-item">
                    <a class="nav-link" href="#">Pinjam</a>
                </li>
            </ul>
        </div>
    </div>
    </nav>

    <main class="container my-5">
        @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
        @yield('content')
    </main>

    <div class="end-page">
        <div class="end-page-content">
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eget sapien vel nisl varius iaculis.
            </p>
            <div class="footer-social-icons">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
            <p class="mt-4">&copy; Libra 2025 | Privacy Policy</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>