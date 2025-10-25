@extends('layouts.guest')

@section('title', 'Visi & Misi - RSHP')

@section('content')
<!-- Header -->
<div class="bg-primary text-white py-5">
    <div class="container">
        <h1 class="display-5 fw-bold">Visi & Misi</h1>
        <p class="lead">Komitmen kami untuk kesehatan hewan</p>
    </div>
</div>

<!-- Content -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Visi -->
            <div class="col-lg-6 mb-4">
                <div class="card h-100 border-primary shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0"><i class="bi bi-eye"></i> Visi</h3>
                    </div>
                    <div class="card-body">
                        <p class="lead">
                            Menjadi rumah sakit hewan terkemuka di Indonesia yang memberikan pelayanan kesehatan hewan berkualitas tinggi dengan standar internasional.
                        </p>
                        <hr>
                        <h5>Nilai-Nilai Kami:</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="bi bi-heart-fill text-danger"></i> <strong>Kasih Sayang</strong> - Memperlakukan setiap hewan dengan penuh kasih sayang
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-shield-check text-success"></i> <strong>Profesionalisme</strong> - Memberikan layanan terbaik dengan standar tertinggi
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-people-fill text-primary"></i> <strong>Integritas</strong> - Berkomitmen pada kejujuran dan transparansi
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-lightbulb-fill text-warning"></i> <strong>Inovasi</strong> - Terus berinovasi dalam pelayanan kesehatan hewan
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Misi -->
            <div class="col-lg-6 mb-4">
                <div class="card h-100 border-success shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h3 class="mb-0"><i class="bi bi-bullseye"></i> Misi</h3>
                    </div>
                    <div class="card-body">
                        <p class="mb-3">Untuk mencapai visi kami, RSHP berkomitmen untuk:</p>
                        <ol class="list-group list-group-numbered">
                            <li class="list-group-item border-0 ps-0">
                                Menyediakan pelayanan kesehatan hewan yang komprehensif, mulai dari pencegahan hingga pengobatan penyakit
                            </li>
                            <li class="list-group-item border-0 ps-0">
                                Menggunakan teknologi dan peralatan medis modern untuk diagnosis dan pengobatan yang akurat
                            </li>
                            <li class="list-group-item border-0 ps-0">
                                Memiliki tim dokter hewan yang berpengalaman dan terus mengembangkan kompetensi melalui pelatihan berkelanjutan
                            </li>
                            <li class="list-group-item border-0 ps-0">
                                Menciptakan lingkungan yang nyaman dan aman bagi hewan peliharaan
                            </li>
                            <li class="list-group-item border-0 ps-0">
                                Memberikan edukasi kepada pemilik hewan tentang perawatan kesehatan yang optimal
                            </li>
                            <li class="list-group-item border-0 ps-0">
                                Berpartisipasi aktif dalam upaya kesejahteraan hewan di masyarakat
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Komitmen -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h3 class="mb-0"><i class="bi bi-hand-thumbs-up"></i> Komitmen Kami</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 text-center mb-3">
                                <i class="bi bi-clock-history display-4 text-primary"></i>
                                <h5 class="mt-3">Pelayanan 24/7</h5>
                                <p>Siap melayani kebutuhan hewan Anda kapan saja</p>
                            </div>
                            <div class="col-md-4 text-center mb-3">
                                <i class="bi bi-award display-4 text-warning"></i>
                                <h5 class="mt-3">Kualitas Terjamin</h5>
                                <p>Standar pelayanan internasional</p>
                            </div>
                            <div class="col-md-4 text-center mb-3">
                                <i class="bi bi-heart-pulse display-4 text-danger"></i>
                                <h5 class="mt-3">Penuh Kasih Sayang</h5>
                                <p>Memperlakukan hewan seperti keluarga sendiri</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
