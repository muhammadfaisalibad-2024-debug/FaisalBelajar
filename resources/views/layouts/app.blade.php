<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'RSHP - Veterinary Hospital Management')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Custom Pagination Styles */
        .pagination {
            margin-bottom: 0;
        }
        
        .pagination .page-link {
            color: #0d6efd;
            border: 1px solid #dee2e6;
            padding: 0.5rem 0.75rem;
            margin: 0 2px;
            border-radius: 0.375rem;
            transition: all 0.3s ease;
        }
        
        .pagination .page-link:hover {
            background-color: #0d6efd;
            color: white;
            border-color: #0d6efd;
            transform: translateY(-2px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .pagination .page-item.active .page-link {
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: white;
            font-weight: 600;
        }
        
        .pagination .page-item.disabled .page-link {
            color: #6c757d;
            background-color: #e9ecef;
            border-color: #dee2e6;
            cursor: not-allowed;
        }
        
        .pagination .page-link:focus {
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }
        
        /* Responsive pagination */
        @media (max-width: 576px) {
            .pagination .page-link {
                padding: 0.375rem 0.5rem;
                font-size: 0.875rem;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            @php
                $user = Auth::user();
                $isAdmin = $user->roles()->wherePivot('status', '1')->where('role.idrole', 1)->exists();
                $isPerawat = $user->roles()->wherePivot('status', '1')->where('role.idrole', 3)->exists();
                $isResepsionis = $user->roles()->wherePivot('status', '1')->where('role.idrole', 4)->exists();
                $isDokter = $user->roles()->wherePivot('status', '1')->where('role.idrole', 2)->exists();
                
                $dashboardRoute = route('dashboard'); // default
                if ($isPerawat) {
                    $dashboardRoute = route('perawat.dashboard');
                } elseif ($isResepsionis) {
                    $dashboardRoute = route('resepsionis.dashboard');
                } elseif ($isDokter) {
                    $dashboardRoute = route('dokter.dashboard');
                }
            @endphp
            
            <a class="navbar-brand" href="{{ $dashboardRoute }}">
                <i class="bi bi-hospital"></i> RSHP
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') || request()->routeIs('*.dashboard') ? 'active' : '' }}" 
                           href="{{ $dashboardRoute }}">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    
                    @if($isAdmin)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-database"></i> Data Master
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.users.index') }}">
                                <i class="bi bi-people"></i> Users
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.role.index') }}">
                                <i class="bi bi-shield"></i> Role
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('admin.dokter.index') }}">
                                <i class="bi bi-person-badge"></i> Dokter
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.perawat.index') }}">
                                <i class="bi bi-hospital"></i> Perawat
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('admin.pemilik.index') }}">
                                <i class="bi bi-person"></i> Pemilik
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.pet.index') }}">
                                <i class="bi bi-heart"></i> Pet / Hewan
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('admin.jenis-hewan.index') }}">
                                <i class="bi bi-collection"></i> Jenis Hewan
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.ras-hewan.index') }}">
                                <i class="bi bi-grid"></i> Ras Hewan
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('admin.kategori.index') }}">
                                <i class="bi bi-tags"></i> Kategori
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.kategori-klinis.index') }}">
                                <i class="bi bi-bookmark"></i> Kategori Klinis
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.kode-tindakan-terapi.index') }}">
                                <i class="bi bi-file-medical"></i> Kode Tindakan Terapi
                            </a></li>
                        </ul>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-journal-medical"></i> Transaksi
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.temu-dokter.index') }}">
                                <i class="bi bi-calendar-check"></i> Temu Dokter
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.rekam-medis.index') }}">
                                <i class="bi bi-file-medical-fill"></i> Rekam Medis
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.detail-rekam.index') }}">
                                <i class="bi bi-clipboard2-pulse"></i> Detail Rekam Medis
                            </a></li>
                        </ul>
                    </li>
                    @endif
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> {{ Auth::user()->nama ?? 'User' }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">
                                <i class="bi bi-gear"></i> Pengaturan
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container-fluid py-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center text-lg-start mt-auto">
        <div class="text-center p-3">
            © {{ date('Y') }} RSHP - Veterinary Hospital Management System
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
