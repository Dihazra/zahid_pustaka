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

        .main-content {
    margin-left: 250px;
    padding: 2rem;
    min-height: 100vh;
    background-color: #0b0f1a;
      font-family: 'Inter', sans-serif;
      color: #fff;/* latar belakang lembut */
}

       
.sidebar {
    width: 300px;
    height: 100vh;
    background-color: #111827;
    backdrop-filter: blur(12px); /* efek blur kaca */
    -webkit-backdrop-filter: blur(12px);
    color: #ffffff;
    position: fixed;
    top: 0;
    left: 0;
    overflow-y: auto;
    z-index: 1030;
    border-right: 1px solid rgba(255, 255, 255, 0.2);
    padding: 20px;
     /* untuk menghindari navbar */
}

.nav-link.active {
    color: orange !important;
    font-weight: bold;
}

.sidebar-heading {
    color: #ffffff;
    font-weight: bold;
    font-size: 1rem;
    letter-spacing: 0.05rem;
    margin-top: 1rem;
    margin-bottom: 0.5rem;
    margin: 0.5rem;
    opacity: 1; /* terang */
}


.sidebar .nav-link {
    font-size: 0.95rem;
    padding: 12px 20px;
     color: rgba(255, 255, 255, 0.7);
    border-radius: 8px;
    transition: background-color 0.3s, color 0.3s;
}

.sidebar .nav-link:hover,
.sidebar .nav-link.active {
    background-color: rgba(255, 255, 255, 0.2);
    color: #FFA500; /* warna oranye terang untuk hover */
}

.sidebar .navbar-brand {
    color: #ffffff !important;
    margin-top: 20px;
    font-weight: bold;
}

.sidebar .navbar-brand:hover {
    color: #FFA500 !important;
}

.sidebar .form-control {
            background-color: rgba(255, 255, 255, 0.1); /* Transparan */
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #ffffff;
        }

        .sidebar .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .sidebar .form-control:focus {
            background-color: rgba(255, 255, 255, 0.2);
            border-color: #FFA500; /* Border oranye saat fokus */
            box-shadow: 0 0 0 0.25rem rgba(255, 165, 0, 0.25);
            color: #ffffff;
        }

        .sidebar .btn-outline-light {
            border-color: rgba(255, 255, 255, 0.3);
            color: #ffffff;
        }

        .sidebar .btn-outline-light:hover {
            background-color: #FFA500;
            border-color: #FFA500;
            color: #6A1B9A; /* Teks berubah menjadi warna dasar sidebar saat hover */
        }

        /* Dropdown menu di sidebar */
        .sidebar .dropdown-menu {
            background-color: #6A1B9A; /* Latar belakang ungu gelap */
            border: none;
        }

        .sidebar .dropdown-item {
            color: #ffffff;
        }

        .sidebar .dropdown-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #FFA500;
        }

        .sidebar .dropdown-item-text {
            color: rgba(255, 255, 255, 0.8);
        }

        .sidebar .dropdown-divider {
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }

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
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="sidebar d-flex flex-column p-3 text-white">
            <a href="/" class="navbar-brand text-white fw-bold fs-4 mb-4">LibraZahid</a>

            <form class="d-flex mb-4" action="{{ route('books.index') }}" method="GET">
                <div class="input-group mb-2">
                    <input class="form-control form-control-sm" name="search" type="search" placeholder="Cari Buku..." value="{{ request('search') }}">
                    <button class="btn btn-outline-light btn-sm" type="submit"><i class="bi bi-search"></i></button>
                </div>
            </form>

            <ul class="nav flex-column mb-auto">

                
                @auth
                    @if(Auth::user()->role === 'admin')
                        <li class="nav-item mb-2">
                            <a class="nav-link {{ request()->is('dashboard') ? 'active' : 'text-white' }}" href="/dashboard">
                                <i class="bi bi-house me-2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link {{ request()->is('tambah') ? 'active' : 'text-white' }}" href="/tambah">
                                <i class="bi bi-book me-2"></i> Manage Books
                            </a>
                        </li>
                        <li class="nav-item mb-2" >
                            <a class="nav-link {{ request()->is('user-action') ? 'active' : 'text-white' }}" href="/user-action">
                                <i class="bi bi-people me-2"></i>  Manage Users
                            </a>
                        </li>
                    <li class="nav-item mb-2">
                        <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link text-white w-100 text-start">
                        <i class="bi bi-box-arrow-left me-2"></i> Logout
                        </button>
                        </form>
                    </li>

                    @endif

                    
                    @if(Auth::user()->role === 'user')
                    <div class="sidebar-heading">Daftar Buku</div>
                    <li class="nav-item mb-2">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : 'text-white' }}" href="{{ route('home') }}">
                            <i class="bi bi-book me-2"></i>Buku
                        </a>
                    </li>

                    <div class="sidebar-heading">Lainnya</div>
                    <li class="nav-item mb-2">
                    <a class="nav-link {{ request()->routeIs('my.loans') ? 'active' : 'text-white' }}" href="{{ route('my.loans') }}">
                        <i class="bi bi-journal-check me-2"></i> Peminjaman
                    </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link">
                            <i class="bi bi-person-square me-2 text-white"></i> {{ Auth::user()->name }}
                        </a>
                    </li>
                    
                    <li class="nav-item mb-2">
                        <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link text-white w-100 text-start">
                        <i class="bi bi-box-arrow-left me-2"></i> Logout
                        </button>
                        </form>
                    </li>

                    @endif
                

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
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
