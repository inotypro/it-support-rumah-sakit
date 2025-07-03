@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <div class="hero-section position-relative">
        <div class="overlay"></div>
        <div class="container">
            <div class="row min-vh-100 align-items-center justify-content-center">
                <div class="col-lg-10">
                    <div class="welcome-content bg-white bg-opacity-90 p-5 rounded-3 shadow-lg text-center">
                        <!-- Logo -->
                        <div class="logo-container mb-4">
                            <img src="{{ asset('images/Rumah_Sakit_Umum_Daerah_Talisayan.webp') }}" alt="RSUD Talisayan Logo" class="img-fluid mb-3" style="max-height: 150px;">
                            <h4 class="text-dark mb-0">PEMERINTAH KAB. BERAU</h4>
                            <h2 class="text-primary mb-4">RSUD TALISAYAN</h2>
                        </div>

                        <h1 class="display-4 fw-bold text-primary mb-3">Selamat Datang</h1>
                        <p class="lead text-dark mb-5">Sistem Informasi Pendaftaran, IT Support, dan Survei Kepuasan</p>
                        
                        <!-- <div class="row g-4 justify-content-center mb-5">
                            <div class="col-md-4">
                                <div class="card h-100 border-0 shadow-sm hover-card">
                                    <div class="card-body text-center p-4">
                                        <div class="feature-icon-wrapper mb-3">
                                            <div class="feature-icon bg-primary text-white">
                                                <i class="fas fa-user-plus fa-lg"></i>
                                            </div>
                                        </div>
                                        <h5 class="card-title fw-bold">Pendaftaran Online</h5>
                                        <p class="card-text text-muted">Daftar kunjungan pasien secara online</p>
                                        <a href="{{ route('registrations.select-type') }}" class="btn btn-primary">Daftar Sekarang</a>
                                    </div>
                                </div>
                            </div> -->
                            
                            <div class="col-md-12">
                                <div class="card h-100 border-0 shadow-sm hover-card">
                                    <div class="card-body text-center p-4">
                                        <div class="feature-icon-wrapper mb-3">
                                            <div class="feature-icon bg-success text-white">
                                                <i class="fas fa-headset fa-lg"></i>
                                            </div>
                                        </div>
                                        <h5 class="card-title fw-bold">IT Support</h5>
                                        <p class="card-text text-muted">Layanan bantuan teknis IT</p>
                                        <a href="{{ route('tickets.create') }}" class="btn btn-success">Buat Tiket</a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- <div class="col-md-4">
                                <div class="card h-100 border-0 shadow-sm hover-card">
                                    <div class="card-body text-center p-4">
                                        <div class="feature-icon-wrapper mb-3">
                                            <div class="feature-icon bg-info text-white">
                                                <i class="fas fa-star fa-lg"></i>
                                            </div>
                                        </div>
                                        <h5 class="card-title fw-bold">Survei Kepuasan</h5>
                                        <p class="card-text text-muted">Berikan penilaian layanan kami</p>
                                        <a href="{{ route('surveys.create') }}" class="btn btn-info text-white">Isi Survei</a>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <!-- Survey Results Section -->
                        <div class="survey-results mt-5 pt-5 border-top">
                            <h3 class="text-center mb-4">Hasil Survei Kepuasan</h3>
                            <div class="row g-4">
                                <div class="col-md-4 mb-4">
                                    <div class="satisfaction-card text-center p-4 rounded-3 bg-light">
                                        <div class="satisfaction-icon mb-3">
                                            <i class="fas fa-hospital text-primary fa-2x"></i>
                                        </div>
                                        <h4 class="satisfaction-title">Pelayanan Medis</h4>
                                        <div class="rating-display">
                                            <div class="stars">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $averageRatings['pelayanan_medis'] ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                            </div>
                                            <div class="rating-value mt-2">
                                                {{ number_format($averageRatings['pelayanan_medis'], 1) }}/5.0
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <div class="satisfaction-card text-center p-4 rounded-3 bg-light">
                                        <div class="satisfaction-icon mb-3">
                                            <i class="fas fa-building text-success fa-2x"></i>
                                        </div>
                                        <h4 class="satisfaction-title">Fasilitas</h4>
                                        <div class="rating-display">
                                            <div class="stars">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $averageRatings['fasilitas'] ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                            </div>
                                            <div class="rating-value mt-2">
                                                {{ number_format($averageRatings['fasilitas'], 1) }}/5.0
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <div class="satisfaction-card text-center p-4 rounded-3 bg-light">
                                        <div class="satisfaction-icon mb-3">
                                            <i class="fas fa-broom text-info fa-2x"></i>
                                        </div>
                                        <h4 class="satisfaction-title">Kebersihan</h4>
                                        <div class="rating-display">
                                            <div class="stars">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $averageRatings['kebersihan'] ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                            </div>
                                            <div class="rating-value mt-2">
                                                {{ number_format($averageRatings['kebersihan'], 1) }}/5.0
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <div class="satisfaction-card text-center p-4 rounded-3 bg-light">
                                        <div class="satisfaction-icon mb-3">
                                            <i class="fas fa-clock text-warning fa-2x"></i>
                                        </div>
                                        <h4 class="satisfaction-title">Kecepatan Pelayanan</h4>
                                        <div class="rating-display">
                                            <div class="stars">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $averageRatings['kecepatan_pelayanan'] ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                            </div>
                                            <div class="rating-value mt-2">
                                                {{ number_format($averageRatings['kecepatan_pelayanan'], 1) }}/5.0
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <div class="satisfaction-card text-center p-4 rounded-3 bg-light">
                                        <div class="satisfaction-icon mb-3">
                                            <i class="fas fa-smile text-danger fa-2x"></i>
                                        </div>
                                        <h4 class="satisfaction-title">Keramahan Staff</h4>
                                        <div class="rating-display">
                                            <div class="stars">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $averageRatings['keramahan_staff'] ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                            </div>
                                            <div class="rating-value mt-2">
                                                {{ number_format($averageRatings['keramahan_staff'], 1) }}/5.0
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.hero-section {
    background: linear-gradient(135deg, #1abc9c, #2ecc71);
    min-height: 100vh;
    position: relative;
}

.overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}

.welcome-content {
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.logo-container h4 {
    font-size: 1.2rem;
    font-weight: 600;
}

.logo-container h2 {
    font-size: 2rem;
    font-weight: 700;
}

.feature-icon-wrapper {
    width: 80px;
    height: 80px;
    margin: 0 auto;
    position: relative;
    background: radial-gradient(circle at center, rgba(255,255,255,0.8) 0%, rgba(255,255,255,0) 70%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.feature-icon {
    width: 60px;
    height: 60px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    box-shadow: 0 4px 15px rgba(0,0,0,0.15);
}

.hover-card {
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.95);
}

.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
}

.satisfaction-card {
    transition: all 0.3s ease;
}

.satisfaction-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.stars {
    font-size: 1.2rem;
}

.rating-value {
    font-size: 1.1rem;
    font-weight: 600;
    color: #2c3e50;
}

.satisfaction-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 1rem;
    color: #2c3e50;
}

.btn {
    padding: 0.5rem 1.5rem;
    border-radius: 50px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.text-primary { color: #2ecc71 !important; }
.bg-primary { background-color: #2ecc71 !important; }
.btn-primary {
    background-color: #2ecc71;
    border-color: #2ecc71;
}
.btn-primary:hover {
    background-color: #27ae60;
    border-color: #27ae60;
}

.bg-success { background-color: #3498db !important; }
.btn-success {
    background-color: #3498db;
    border-color: #3498db;
}
.btn-success:hover {
    background-color: #2980b9;
    border-color: #2980b9;
}

.bg-info { background-color: #e74c3c !important; }
.btn-info {
    background-color: #e74c3c;
    border-color: #e74c3c;
}
.btn-info:hover {
    background-color: #c0392b;
    border-color: #c0392b;
}
</style>
@endsection
