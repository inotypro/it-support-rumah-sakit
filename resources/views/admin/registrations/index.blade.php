@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Daftar Pendaftaran</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <!-- Filters -->
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('admin.registrations.search') }}" method="GET" class="row g-3">
                        <div class="col-md-3">
                            <input type="text" name="search" class="form-control" placeholder="Cari nama/no. RM..." value="{{ request('search') }}">
                        </div>
                        <div class="col-md-2">
                            <select name="patient_type" class="form-select">
                                <option value="">Semua Tipe</option>
                                <option value="baru" {{ request('patient_type') === 'baru' ? 'selected' : '' }}>Pasien Baru</option>
                                <option value="lama" {{ request('patient_type') === 'lama' ? 'selected' : '' }}>Pasien Lama</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="status" class="form-select">
                                <option value="">Semua Status</option>
                                <option value="proses" {{ request('status') === 'proses' ? 'selected' : '' }}>Proses</option>
                                <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="batal" {{ request('status') === 'batal' ? 'selected' : '' }}>Batal</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search me-2"></i>Filter
                            </button>
                            <a href="{{ route('admin.registrations.index') }}" class="btn btn-secondary">
                                <i class="fas fa-redo me-2"></i>Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Statistics -->
            <div class="row mb-4">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $registrations->where('patient_type', 'baru')->count() }}</h3>
                            <p>Pasien Baru</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $registrations->where('patient_type', 'lama')->count() }}</h3>
                            <p>Pasien Lama</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-check"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $registrations->where('status', 'proses')->count() }}</h3>
                            <p>Dalam Proses</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $registrations->where('status', 'batal')->count() }}</h3>
                            <p>Dibatalkan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-times-circle"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Registrations Table -->
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>No. RM</th>
                                    <th>Nama</th>
                                    <th>Tipe</th>
                                    <th>NIK</th>
                                    <th>Poli</th>
                                    <th>Status</th>
                                    <th width="100">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($registrations as $registration)
                                <tr>
                                    <td>{{ $registration->created_at->format('d/m/Y H:i') }}</td>
                                    <td>{{ $registration->medical_record_number ?? '-' }}</td>
                                    <td>{{ $registration->full_name }}</td>
                                    <td>{!! $registration->patient_type_badge !!}</td>
                                    <td>{{ $registration->nik ?? '-' }}</td>
                                    <td>{{ $registration->poly }}</td>
                                    <td>{!! $registration->status_badge !!}</td>
                                    <td>
                                        <div class="btn-group">
                                            <!-- Tombol Lihat Detail -->
                                            <a href="{{ route('admin.registrations.show', $registration) }}" 
                                               class="btn btn-sm btn-primary" 
                                               title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('admin.registrations.destroy', $registration) }}" 
                                                  method="POST" 
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-danger" 
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" 
                                                        title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">Tidak ada data pendaftaran</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($registrations->hasPages())
                <div class="card-footer">
                    {{ $registrations->links() }}
                </div>
                @endif
            </div>
        </div>
    </section>
</div>

<style>
.small-box {
    border-radius: 10px;
    position: relative;
    display: block;
    margin-bottom: 20px;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
}
.small-box > .inner {
    padding: 10px;
}
.small-box h3 {
    font-size: 38px;
    font-weight: bold;
    margin: 0 0 10px 0;
    white-space: nowrap;
    padding: 0;
}
.small-box p {
    font-size: 15px;
    margin-bottom: 0;
}
.small-box .icon {
    position: absolute;
    top: 5px;
    right: 10px;
    z-index: 0;
    font-size: 70px;
    color: rgba(0,0,0,0.15);
}
.btn-group {
    gap: 0.25rem;
}
.dropdown-menu {
    padding: 0.5rem;
}
.dropdown-item {
    border-radius: 0.25rem;
    padding: 0.5rem 1rem;
}
.dropdown-item:hover {
    background-color: #f8f9fa;
}
.dropdown-item i {
    width: 1rem;
    text-align: center;
    margin-right: 0.5rem;
}
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush
@endsection 