@extends('layouts.guest')

@section('title', 'Struktur Organisasi - RSHP')

@section('content')
<!-- Header -->
<div class="bg-primary text-white py-5">
    <div class="container">
        <h1 class="display-5 fw-bold">Struktur Organisasi</h1>
        <p class="lead">Tim profesional kami</p>
    </div>
</div>

<!-- Content -->
<section class="py-5">
    <div class="container">
        <!-- Direktur -->
        <div class="text-center mb-5">
            <div class="card shadow-sm mx-auto" style="max-width: 400px;">
                <div class="card-body p-4">
                    <div class="mb-3">
                        <i class="bi bi-person-circle display-1 text-primary"></i>
                    </div>
                    <h4 class="fw-bold">Dr. Ahmad Santoso, DVM</h4>
                    <p class="text-muted mb-0">Direktur Utama</p>
                    <small class="text-muted">Dokter Hewan Senior | 20 Tahun Pengalaman</small>
                </div>
            </div>
        </div>

        <!-- Divider -->
        <div class="text-center mb-4">
            <i class="bi bi-arrow-down display-4 text-secondary"></i>
        </div>

        <!-- Manajer -->
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center p-4">
                        <i class="bi bi-person-badge display-4 text-success mb-3"></i>
                        <h5 class="fw-bold">Dr. Siti Nurhaliza, DVM</h5>
                        <p class="text-muted mb-2">Manajer Medis</p>
                        <small class="text-muted">Spesialis Bedah & Operasi</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center p-4">
                        <i class="bi bi-person-badge display-4 text-info mb-3"></i>
                        <h5 class="fw-bold">Budi Santoso, S.Farm</h5>
                        <p class="text-muted mb-2">Manajer Farmasi</p>
                        <small class="text-muted">Apoteker & Pengelola Obat</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center p-4">
                        <i class="bi bi-person-badge display-4 text-warning mb-3"></i>
                        <h5 class="fw-bold">Dewi Lestari, S.E.</h5>
                        <p class="text-muted mb-2">Manajer Administrasi</p>
                        <small class="text-muted">Keuangan & SDM</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Divider -->
        <div class="text-center mb-4">
            <i class="bi bi-arrow-down display-4 text-secondary"></i>
        </div>

        <!-- Tim Dokter -->
        <div class="mb-5">
            <h3 class="text-center mb-4"><i class="bi bi-hospital"></i> Tim Dokter Hewan</h3>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-person-circle display-4 text-primary mb-2"></i>
                            <h6 class="fw-bold">Dr. John Doe</h6>
                            <small class="text-muted">Dokter Umum</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-person-circle display-4 text-primary mb-2"></i>
                            <h6 class="fw-bold">Dr. Jane Smith</h6>
                            <small class="text-muted">Spesialis Kucing</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-person-circle display-4 text-primary mb-2"></i>
                            <h6 class="fw-bold">Dr. Michael Wong</h6>
                            <small class="text-muted">Spesialis Anjing</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-person-circle display-4 text-primary mb-2"></i>
                            <h6 class="fw-bold">Dr. Sarah Lee</h6>
                            <small class="text-muted">Spesialis Burung</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tim Perawat -->
        <div class="mb-5">
            <h3 class="text-center mb-4"><i class="bi bi-hospital"></i> Tim Perawat & Staff</h3>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-person-hearts display-4 text-success mb-2"></i>
                            <h6 class="fw-bold">Tim Perawat</h6>
                            <small class="text-muted">5 Orang Perawat Berpengalaman</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-scissors display-4 text-warning mb-2"></i>
                            <h6 class="fw-bold">Tim Groomer</h6>
                            <small class="text-muted">3 Orang Groomer Profesional</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-person-workspace display-4 text-info mb-2"></i>
                            <h6 class="fw-bold">Tim Administrasi</h6>
                            <small class="text-muted">4 Orang Staff Admin</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Info -->
        <div class="alert alert-info">
            <i class="bi bi-info-circle"></i> 
            <strong>Total Tim:</strong> Lebih dari 25 profesional yang berdedikasi untuk kesehatan hewan peliharaan Anda
        </div>
    </div>
</section>
@endsection
