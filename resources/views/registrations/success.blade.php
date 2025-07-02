@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-check-circle text-success" style="font-size: 5rem;"></i>
                    <h3 class="mt-4">Pendaftaran Berhasil!</h3>
                    <p class="lead">
                        Terima kasih telah mendaftar di RSUD Talisayan.<br>
                        Kami akan menghubungi Anda melalui SMS/WhatsApp untuk konfirmasi jadwal.
                    </p>
                    <div class="alert alert-info">
                        <h5>Hal yang perlu diperhatikan:</h5>
                        <ul class="text-start mb-0">
                            <li>Harap membawa kartu identitas (KTP)</li>
                            <li>Jika menggunakan BPJS, bawa kartu BPJS yang masih aktif</li>
                            <li>Datang 30 menit sebelum jadwal yang ditentukan</li>
                            <li>Jika ada pertanyaan, silakan hubungi nomor WhatsApp kami</li>
                        </ul>
                    </div>
                    <a href="{{ route('registrations.index') }}" class="btn btn-primary">Kembali ke Halaman Pendaftaran</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 