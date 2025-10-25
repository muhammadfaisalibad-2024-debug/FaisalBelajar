@extends('layouts.guest')

@section('title', 'Home - RSHP')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Selamat Datang di RSHP</h1>
                <p class="lead mb-4">
                    Rumah Sakit Hewan Profesional - Memberikan pelayanan kesehatan terbaik untuk hewan kesayangan Anda
                </p>
                <a href="{{ route('layanan') }}" class="btn btn-light btn-lg">
                    Lihat Layanan Kami <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="col-lg-6 text-center">
                <i class="bi bi-heart-pulse display-1"></i>
            </div>
        </div>
    </div>
</section>

<!-- Services Preview -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Layanan Kami</h2>
            <p class="text-muted">Pelayanan kesehatan hewan yang komprehensif</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card service-card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <i class="bi bi-clipboard2-pulse text-primary display-4 mb-3"></i>
                        <h5 class="card-title">Konsultasi Kesehatan</h5>
                        <p class="card-text text-muted">
                            Konsultasi dengan dokter hewan profesional untuk kesehatan hewan peliharaan Anda
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card service-card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <i class="bi bi-capsule text-success display-4 mb-3"></i>
                        <h5 class="card-title">Vaksinasi</h5>
                        <p class="card-text text-muted">
                            Program vaksinasi lengkap untuk melindungi hewan dari berbagai penyakit
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card service-card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <i class="bi bi-scissors text-warning display-4 mb-3"></i>
                        <h5 class="card-title">Grooming</h5>
                        <p class="card-text text-muted">
                            Perawatan dan grooming profesional untuk menjaga kebersihan hewan
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="fw-bold mb-4">Mengapa Memilih RSHP?</h2>
                <div class="d-flex mb-3">
                    <i class="bi bi-check-circle-fill text-success fs-4 me-3"></i>
                    <div>
                        <h5>Dokter Hewan Berpengalaman</h5>
                        <p class="text-muted">Tim dokter hewan profesional dan berpengalaman</p>
                    </div>
                </div>
                <div class="d-flex mb-3">
                    <i class="bi bi-check-circle-fill text-success fs-4 me-3"></i>
                    <div>
                        <h5>Fasilitas Modern</h5>
                        <p class="text-muted">Peralatan medis lengkap dan modern</p>
                    </div>
                </div>
                <div class="d-flex mb-3">
                    <i class="bi bi-check-circle-fill text-success fs-4 me-3"></i>
                    <div>
                        <h5>Pelayanan 24 Jam</h5>
                        <p class="text-muted">Siap melayani kebutuhan hewan Anda kapan saja</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <i class="bi bi-hospital display-1 text-primary"></i>
            </div>
        </div>
    </div>
</section>
@endsection
