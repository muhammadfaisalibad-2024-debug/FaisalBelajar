@extends('layouts.guest')

@section('title', 'Layanan - RSHP')

@section('content')

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                <i class="bi bi-hospital text-primary"></i> RSHP
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('layanan') }}">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('visi-misi') }}">Visi & Misi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('struktur-org') }}">Struktur Organisasi</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link btn btn-primary text-white px-3" href="{{ route('dashboard') }}">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-primary px-3" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right"></i> Login
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">Selamat Datang di RSHP</h1>
            <p class="lead mb-5">Rumah Sakit Hewan Peliharaan - Layanan Kesehatan Terbaik untuk Hewan Kesayangan Anda</p>
            <a href="{{ route('layanan') }}" class="btn btn-light btn-lg px-5">
                <i class="bi bi-heart-pulse"></i> Lihat Layanan Kami
            </a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">Mengapa Memilih RSHP?</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-hospital feature-icon"></i>
                            <h5 class="card-title mt-3 fw-bold">Fasilitas Modern</h5>
                            <p class="card-text text-muted">Dilengkapi dengan peralatan medis terkini dan ruang perawatan yang nyaman.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-people feature-icon"></i>
                            <h5 class="card-title mt-3 fw-bold">Tim Profesional</h5>
                            <p class="card-text text-muted">Dokter hewan berpengalaman dan perawat terlatih siap melayani 24/7.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-heart feature-icon"></i>
                            <h5 class="card-title mt-3 fw-bold">Pelayanan Terbaik</h5>
                            <p class="card-text text-muted">Kami memberikan perhatian penuh dan kasih sayang untuk setiap pasien.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Preview -->
    <section class="bg-light py-5">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">Layanan Kami</h2>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-clipboard2-pulse text-primary" style="font-size: 2.5rem;"></i>
                            <h6 class="mt-3 fw-bold">Pemeriksaan Umum</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-capsule text-primary" style="font-size: 2.5rem;"></i>
                            <h6 class="mt-3 fw-bold">Vaksinasi</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-scissors text-primary" style="font-size: 2.5rem;"></i>
                            <h6 class="mt-3 fw-bold">Operasi</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-house-heart text-primary" style="font-size: 2.5rem;"></i>
                            <h6 class="mt-3 fw-bold">Rawat Inap</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('layanan') }}" class="btn btn-primary px-4">Lihat Semua Layanan</a>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="fw-bold mb-4">Hubungi Kami</h2>
                    <p class="text-muted mb-4">Butuh konsultasi atau informasi lebih lanjut? Jangan ragu untuk menghubungi kami!</p>
                    <div class="mb-3">
                        <i class="bi bi-geo-alt text-primary"></i>
                        <span class="ms-2">Jl. Kesehatan Hewan No. 123, Jakarta</span>
                    </div>
                    <div class="mb-3">
                        <i class="bi bi-telephone text-primary"></i>
                        <span class="ms-2">(021) 123-4567</span>
                    </div>
                    <div class="mb-3">
                        <i class="bi bi-envelope text-primary"></i>
                        <span class="ms-2">info@rshp.com</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-4">Jam Operasional</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td>Senin - Jumat</td>
                                    <td class="text-end fw-bold">08:00 - 20:00</td>
                                </tr>
                                <tr>
                                    <td>Sabtu</td>
                                    <td class="text-end fw-bold">08:00 - 16:00</td>
                                </tr>
                                <tr>
                                    <td>Minggu</td>
                                    <td class="text-end fw-bold">10:00 - 14:00</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center pt-3">
                                        <span class="badge bg-success">Layanan Darurat 24 Jam</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p class="mb-0">&copy; {{ date('Y') }} RSHP - Rumah Sakit Hewan Peliharaan. All Rights Reserved.</p>
            <p class="mt-2 mb-0">
                <a href="#" class="text-white me-3"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-white me-3"><i class="bi bi-instagram"></i></a>
                <a href="#" class="text-white"><i class="bi bi-twitter"></i></a>
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
