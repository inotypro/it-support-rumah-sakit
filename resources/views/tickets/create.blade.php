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
                            <div class="card-header bg-primary text-white p-4">
                                <div class="d-flex align-items-center">
                                    <div class="feature-icon-wrapper me-3">
                                        <div class="feature-icon bg-white text-primary rounded-circle p-3">
                                            <i class="fas fa-headset fa-lg"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="mb-0">Form Tiket IT Support</h4>
                                        <p class="mb-0">Silakan isi form di bawah ini untuk membuat tiket bantuan IT</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="name" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="unit" class="form-label">Unit/Bagian</label>
                                        <input type="text" class="form-control @error('unit') is-invalid @enderror" id="unit" name="unit" value="{{ old('unit') }}" required>
                                        @error('unit')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="phone" class="form-label">Nomor HP</label>
                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required>
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="description" class="form-label">Deskripsi Masalah</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="image" class="form-label">Lampiran Gambar (Opsional)</label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Format yang didukung: JPG, PNG, GIF (Max. 2MB)</div>
                                    </div>

                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="fas fa-paper-plane me-2"></i>Kirim Tiket
                                        </button>
                                        <a href="{{ route('welcome') }}" class="btn btn-light btn-lg">
                                            <i class="fas fa-arrow-left me-2"></i>Kembali
                                        </a>
                                    </div>
                                </form>
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

.feature-icon {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.form-control:focus {
    border-color: #2ecc71;
    box-shadow: 0 0 0 0.25rem rgba(46, 204, 113, 0.25);
}
</style>
@endsection 