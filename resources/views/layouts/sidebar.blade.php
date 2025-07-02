<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Libra | Perpustakaan Digital</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
       
.sidebar {
    width: 250px;
    height: 100vh;
    background: rgba(51, 51, 51, 0.5); /* abu-abu gelap transparan */
    backdrop-filter: blur(12px); /* efek blur kaca */
    -webkit-backdrop-filter: blur(12px);
    color: #ffffff;
    position: fixed;
    top: 0;
    left: 0;
    overflow-y: auto;
    z-index: 1030;
    border-right: 1px solid rgba(255, 255, 255, 0.1);
}


.main-content {
    margin-left: 250px;
    padding: 2rem;
    min-height: 100vh;
    background-color: rgba(128, 128, 128, 0.05); /* latar belakang lembut */
}


.sidebar .nav-link {
    font-size: 0.95rem;
    padding: 12px 20px;
    color: #ffffff;
    border-radius: 8px;
    transition: background-color 0.3s, color 0.3s;
}

.sidebar .nav-link:hover,
.sidebar .nav-link.active {
    background-color: rgba(255, 255, 255, 0.1);
    color: #FFA500; /* warna oranye terang untuk hover */
}

.sidebar .navbar-brand {
    color: #ffffff !important;
}

.sidebar .navbar-brand:hover {
    color: #FFA500 !important;
}


    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="sidebar d-flex flex-column p-3 text-white">
            <a href="/" class="navbar-brand text-white fw-bold fs-4 mb-4">Libra</a>

            <form class="d-flex mb-4" action="{{ route('books.index') }}" method="GET">
                <div class="input-group">
                    <input class="form-control form-control-sm" name="search" type="search" placeholder="Cari Buku..." value="{{ request('search') }}">
                    <button class="btn btn-outline-light btn-sm" type="submit"><i class="bi bi-search"></i></button>
                </div>
            </form>

            <ul class="nav flex-column mb-auto">

                <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('home') }}">
                            <i class="bi bi-book me-2"></i> Daftar Buku
                        </a>
                </li>
                @auth
                    @if(Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/dashboard">
                                <i class="bi bi-book-fill me-2"></i> Manage Books
                            </a>
                        </li>
                    @endif

                    

                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('my.loans') }}">
                            <i class="bi bi-journal-check me-2"></i> Peminjaman Saya
                        </a>
                    </li>


                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-person-square me-2"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><span class="dropdown-item-text">{{ Auth::user()->email }}</span></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="/logout" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('login') }}">
                            <i class="bi bi-person-square me-2"></i> Login
                        </a>
                    </li>
                @endauth
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="main-content flex-grow-1 p-4">
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
        </div>
    </div>

    <!-- Footer -->
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
