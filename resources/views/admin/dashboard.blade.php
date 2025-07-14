@extends('layouts.sidebar')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard</h1>

    <!-- Kartu Statistik -->
    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Pengunjung</h5>
                    <p class="card-text fs-4">{{ $jumlahPengunjung }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Buku Dipinjam</h5>
                    <p class="card-text fs-4">{{ $jumlahPinjam }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Sedang Dipinjam</h5>
                    <p class="card-text fs-4">{{ $pinjamAktif }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Sudah Dikembalikan</h5>
                    <p class="card-text fs-4">{{ $pinjamSelesai }}</p>
                </div>
            </div>
        </div>
    </div>

<div class="card bg-dark text-white mt-4">
    <div class="card-header">📚 Buku Paling Populer</div>
    <div class="card-body">
        <ul class="list-group list-group-flush">
            @forelse($bukuPopuler as $buku)
                <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent text-white">
                    <div>
                        <strong>{{ $buku->title }}</strong><br>
                        <small class="text-muted">oleh {{ $buku->author }}</small>
                    </div>
                    <span class="badge bg-warning text-dark">{{ $buku->total }}x dipinjam</span>
                </li>
            @empty
                <li class="list-group-item text-muted bg-transparent">Belum ada data peminjaman.</li>
            @endforelse
        </ul>
    </div>
</div>


    <!-- Grafik Statistik -->
    <div class="row mt-4">
        <!-- Donut Chart: Statistik Peminjaman -->
        <div class="col-md-6">
            <div class="card bg-dark text-white mb-4">
                <div class="card-header">Statistik Peminjaman</div>
                <div class="card-body">
                    <canvas id="peminjamanChart" height="200"></canvas>
                </div>
            </div>
        </div>

        <!-- Bar Chart: Statistik Umum -->
        <div class="col-md-6">
            <div class="card bg-dark text-white mb-4">
                <div class="card-header">Statistik Umum</div>
                <div class="card-body">
                    <canvas id="statistikUmumChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Grafik Donut - Statistik Peminjaman
    const peminjamanChart = new Chart(document.getElementById('peminjamanChart').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: ['Sedang Dipinjam', 'Sudah Dikembalikan'],
            datasets: [{
                data: @json([$pinjamAktif, $pinjamSelesai]),
                backgroundColor: ['#FFC107', '#0dcaf0'],
                borderColor: ['#FFC107', '#0dcaf0'],
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: {
                    labels: {
                        color: '#fff'
                    }
                }
            }
        }
    });

    // Grafik Bar - Statistik Umum
    const statistikUmumChart = new Chart(document.getElementById('statistikUmumChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: ['Jumlah Pengunjung', 'Jumlah Buku'],
            datasets: [{
                label: 'Jumlah',
                data: @json([$jumlahPengunjung, $jumlahBuku]),
                backgroundColor: ['#6610f2', '#20c997'],
                borderColor: ['#5a0fd3', '#1cae87'],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { color: '#fff' },
                    grid: { color: 'rgba(255,255,255,0.1)' }
                },
                x: {
                    ticks: { color: '#fff' },
                    grid: { color: 'rgba(255,255,255,0.1)' }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        color: '#fff'
                    }
                }
            }
        }
    });
</script>
@endpush
