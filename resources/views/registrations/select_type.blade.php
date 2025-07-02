@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Pilih Tipe Pasien</h4>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body text-center p-4">
                                    <div class="mb-4">
                                        <i class="fas fa-user-plus fa-3x" style="color: #004d40;"></i>
                                    </div>
                                    <h5 class="card-title">Pasien Baru</h5>
                                    <p class="card-text">Belum pernah berobat di RSUD Talisayan atau belum memiliki nomor rekam medis.</p>
                                    <a href="{{ route('registrations.create', ['type' => 'baru']) }}" class="btn btn-primary">Daftar Sebagai Pasien Baru</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body text-center p-4">
                                    <div class="mb-4">
                                        <i class="fas fa-user-check fa-3x" style="color: #004d40;"></i>
                                    </div>
                                    <h5 class="card-title">Pasien Lama</h5>
                                    <p class="card-text">Sudah pernah berobat di RSUD Talisayan dan memiliki nomor rekam medis.</p>
                                    <a href="{{ route('registrations.create', ['type' => 'lama']) }}" class="btn btn-primary">Daftar Sebagai Pasien Lama</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 