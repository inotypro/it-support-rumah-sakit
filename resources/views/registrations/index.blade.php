@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Pendaftaran Online Rawat Jalan RSUD Talisayan</h4>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h5>Silakan pilih jenis pasien:</h5>
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <a href="{{ route('registrations.create', ['type' => 'baru']) }}" class="btn btn-primary btn-lg w-100 mb-3">
                                    <i class="fas fa-user-plus mb-2"></i>
                                    <br>Pasien Baru
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('registrations.create', ['type' => 'lama']) }}" class="btn btn-success btn-lg w-100 mb-3">
                                    <i class="fas fa-user-check mb-2"></i>
                                    <br>Pasien Lama
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <h5 class="alert-heading"><i class="fas fa-info-circle"></i> Informasi Penting:</h5>
                        <ul class="mb-0">
                            <li>Pendaftaran online dibuka 24 jam</li>
                            <li>Konfirmasi pendaftaran akan dikirim melalui SMS/WhatsApp</li>
                            <li>Harap membawa dokumen pendukung saat datang ke rumah sakit</li>
                            <li>Untuk pasien BPJS, harap membawa kartu BPJS yang masih aktif</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 