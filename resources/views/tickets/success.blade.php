@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <div class="hero-section position-relative">
        <div class="overlay"></div>
        <div class="container">
            <div class="row min-vh-100 align-items-center justify-content-center">
                <div class="col-lg-8">
                    <div class="welcome-content bg-white bg-opacity-90 p-5 rounded-3 shadow-lg">
                        <!-- Logo -->
                        <div class="text-center mb-4">
                            <img src="{{ asset('images/Rumah_Sakit_Umum_Daerah_Talisayan.webp') }}" alt="RSUD Talisayan Logo" class="img-fluid mb-3" style="max-height: 100px;">
                            <h4 class="text-dark mb-0">PEMERINTAH KAB. BERAU</h4>
                            <h2 class="text-primary mb-4">RSUD TALISAYAN</h2>
                        </div>

                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center p-5">
                                <div class="mb-4">
                                    <i class="fas fa-check-circle text-success" style="font-size: 60px;"></i>
                                </div>
                                <h3 class="card-title">Tiket Berhasil Dibuat!</h3>
                                <p class="card-text">Tim IT Support kami akan segera menindaklanjuti tiket Anda.</p>
                                <div class="mt-4">
                                    <a href="{{ route('welcome') }}" class="btn btn-primary">Kembali ke Beranda</a>
                                    <a href="{{ route('tickets.create') }}" class="btn btn-outline-primary">Buat Tiket Baru</a>
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
</style>
@endsection 