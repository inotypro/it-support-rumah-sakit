@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Pendaftaran</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.registrations.index') }}">Pendaftaran</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title">Data Pendaftaran Pasien</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="border-bottom pb-2">Data Pribadi</h5>
                                    <table class="table table-borderless">
                                        <tr>
                                            <th width="200">No. Rekam Medis</th>
                                            <td>{{ $registration->medical_record_number ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama Lengkap</th>
                                            <td>{{ $registration->full_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>NIK</th>
                                            <td>{{ $registration->nik ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Kelamin</th>
                                            <td>{{ $registration->gender ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Lahir</th>
                                            <td>{{ $registration->birth_date ? date('d/m/Y', strtotime($registration->birth_date)) : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Agama</th>
                                            <td>{{ $registration->religion ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Pendidikan</th>
                                            <td>{{ $registration->education ?? '-' }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="border-bottom pb-2">Data Tambahan</h5>
                                    <table class="table table-borderless">
                                        <tr>
                                            <th width="200">Status Perkawinan</th>
                                            <td>{{ $registration->marital_status ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama Suami/Istri/Ortu</th>
                                            <td>{{ $registration->spouse_parent_name ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama Ibu</th>
                                            <td>{{ $registration->mother_name ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>No. HP/WA</th>
                                            <td>{{ $registration->phone_number }}</td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td>{{ $registration->address ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Poli Tujuan</th>
                                            <td>{{ $registration->poly }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Pendaftaran</th>
                                            <td>{{ $registration->created_at->format('d/m/Y H:i') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h5 class="card-title mb-0">Update Status & Edit</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.registrations.update-status', $registration) }}" method="POST" class="mb-4">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status Pendaftaran</label>
                                    <select name="status" id="status" class="form-select status-select">
                                        <option value="proses" {{ $registration->status == 'proses' ? 'selected' : '' }} class="text-warning">Dalam Proses</option>
                                        <option value="selesai" {{ $registration->status == 'selesai' ? 'selected' : '' }} class="text-success">Selesai</option>
                                        <option value="batal" {{ $registration->status == 'batal' ? 'selected' : '' }} class="text-danger">Dibatalkan</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 mb-3">
                                    <i class="fas fa-save"></i> Update Status
                                </button>
                            </form>

                            <a href="{{ route('admin.registrations.edit', $registration) }}" class="btn btn-warning w-100 mb-3">
                                <i class="fas fa-edit"></i> Edit Data Pasien
                            </a>

                            <form action="{{ route('admin.registrations.destroy', $registration) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    <i class="fas fa-trash"></i> Hapus Data
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="card mt-4">
                        <div class="card-body">
                            <a href="{{ route('admin.registrations.index') }}" class="btn btn-secondary w-100">
                                <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('styles')
<style>
.status-select option[value="proses"] {
    color: #ffc107;
    background-color: #f8f9fa;
}
.status-select option[value="selesai"] {
    color: #198754;
    background-color: #f8f9fa;
}
.status-select option[value="batal"] {
    color: #dc3545;
    background-color: #f8f9fa;
}
.card {
    box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const statusSelect = document.querySelector('.status-select');
    function updateStatusSelectColor(select) {
        const value = select.value;
        select.className = 'form-select status-select';
        if (value === 'proses') {
            select.classList.add('text-warning');
        } else if (value === 'selesai') {
            select.classList.add('text-success');
        } else if (value === 'batal') {
            select.classList.add('text-danger');
        }
    }

    if (statusSelect) {
        updateStatusSelectColor(statusSelect);
        statusSelect.addEventListener('change', function() {
            updateStatusSelectColor(this);
        });
    }
});
</script>
@endpush
@endsection 