@extends('layouts.guest')

@section('title', 'Layanan - RSHP')

@section('content')
<!-- Header -->
<div class="bg-primary text-white py-5">
    <div class="container">
        <h1 class="display-5 fw-bold">Layanan Kami</h1>
        <p class="lead">Pelayanan kesehatan hewan yang komprehensif</p>
    </div>
</div>

<!-- Services -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Konsultasi -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <i class="bi bi-clipboard2-pulse text-primary" style="font-size: 3rem;"></i>
                        </div>
                        <h4 class="card-title text-center">Konsultasi Kesehatan</h4>
                        <p class="card-text">
                            Konsultasi dengan dokter hewan profesional untuk berbagai masalah kesehatan hewan peliharaan Anda.
                        </p>
                        <ul class="list-unstyled">
                            <li><i class="bi bi-check-circle text-success"></i> Pemeriksaan rutin</li>
                            <li><i class="bi bi-check-circle text-success"></i> Diagnosis penyakit</li>
                            <li><i class="bi bi-check-circle text-success"></i> Konsultasi nutrisi</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Vaksinasi -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <i class="bi bi-capsule text-success" style="font-size: 3rem;"></i>
                        </div>
                        <h4 class="card-title text-center">Vaksinasi</h4>
                        <p class="card-text">
                            Program vaksinasi lengkap untuk melindungi hewan peliharaan dari berbagai penyakit menular.
                        </p>
                        <ul class="list-unstyled">
                            <li><i class="bi bi-check-circle text-success"></i> Vaksin anjing & kucing</li>
                            <li><i class="bi bi-check-circle text-success"></i> Vaksin rabies</li>
                            <li><i class="bi bi-check-circle text-success"></i> Jadwal vaksinasi</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Grooming -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <i class="bi bi-scissors text-warning" style="font-size: 3rem;"></i>
                        </div>
                        <h4 class="card-title text-center">Grooming</h4>
                        <p class="card-text">
                            Perawatan dan grooming profesional untuk menjaga kebersihan dan penampilan hewan peliharaan.
                        </p>
                        <ul class="list-unstyled">
                            <li><i class="bi bi-check-circle text-success"></i> Mandi & potong kuku</li>
                            <li><i class="bi bi-check-circle text-success"></i> Cukur bulu</li>
                            <li><i class="bi bi-check-circle text-success"></i> Perawatan telinga</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Operasi -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <i class="bi bi-bandaid text-danger" style="font-size: 3rem;"></i>
                        </div>
                        <h4 class="card-title text-center">Operasi</h4>
                        <p class="card-text">
                            Tindakan operasi dengan fasilitas dan tim medis yang profesional.
                        </p>
                        <ul class="list-unstyled">
                            <li><i class="bi bi-check-circle text-success"></i> Sterilisasi</li>
                            <li><i class="bi bi-check-circle text-success"></i> Operasi tumor</li>
                            <li><i class="bi bi-check-circle text-success"></i> Operasi darurat</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Rawat Inap -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <i class="bi bi-house-heart text-info" style="font-size: 3rem;"></i>
                        </div>
                        <h4 class="card-title text-center">Rawat Inap</h4>
                        <p class="card-text">
                            Fasilitas perawatan intensif untuk hewan yang memerlukan pengawasan khusus.
                        </p>
                        <ul class="list-unstyled">
                            <li><i class="bi bi-check-circle text-success"></i> Perawatan 24 jam</li>
                            <li><i class="bi bi-check-circle text-success"></i> Kandang nyaman</li>
                            <li><i class="bi bi-check-circle text-success"></i> Monitoring ketat</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Laboratorium -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <i class="bi bi-file-medical text-primary" style="font-size: 3rem;"></i>
                        </div>
                        <h4 class="card-title text-center">Laboratorium</h4>
                        <p class="card-text">
                            Layanan pemeriksaan laboratorium lengkap untuk diagnosis yang akurat.
                        </p>
                        <ul class="list-unstyled">
                            <li><i class="bi bi-check-circle text-success"></i> Tes darah</li>
                            <li><i class="bi bi-check-circle text-success"></i> Tes urine</li>
                            <li><i class="bi bi-check-circle text-success"></i> Tes feses</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="bg-light py-5">
    <div class="container text-center">
        <h2 class="mb-4">Butuh Layanan Kami?</h2>
        <p class="lead mb-4">Hubungi kami untuk konsultasi atau buat janji temu</p>
        <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Login untuk Membuat Janji</a>
    </div>
</section>
@endsection
