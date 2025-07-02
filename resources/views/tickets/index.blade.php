@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <div class="hero-section position-relative">
        <div class="overlay"></div>
        <div class="container">
            <div class="row min-vh-100 align-items-center justify-content-center">
                <div class="col-lg-10">
                    <div class="welcome-content bg-white bg-opacity-90 p-5 rounded-3 shadow-lg">
                        <!-- Logo -->
                        <div class="text-center mb-4">
                            <img src="{{ asset('images/Rumah_Sakit_Umum_Daerah_Talisayan.webp') }}" alt="RSUD Talisayan Logo" class="img-fluid mb-3" style="max-height: 100px;">
                            <h4 class="text-dark mb-0">PEMERINTAH KAB. BERAU</h4>
                            <h2 class="text-primary mb-4">RSUD TALISAYAN</h2>
                        </div>

                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-primary text-white p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="feature-icon-wrapper me-3">
                                            <div class="feature-icon bg-white text-primary rounded-circle p-3">
                                                <i class="fas fa-ticket-alt fa-lg"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h4 class="mb-0">Tiket IT Support Saya</h4>
                                            <p class="mb-0">Daftar tiket yang telah Anda buat</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('tickets.create') }}" class="btn btn-light">
                                        <i class="fas fa-plus me-2"></i>Buat Tiket Baru
                                    </a>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                @if($tickets->isEmpty())
                                    <div class="text-center py-5">
                                        <div class="feature-icon bg-light text-primary rounded-circle p-3 mx-auto mb-4" style="width: 80px; height: 80px;">
                                            <i class="fas fa-ticket-alt fa-2x"></i>
                                        </div>
                                        <h5>Belum Ada Tiket</h5>
                                        <p class="text-muted">Anda belum membuat tiket IT Support</p>
                                        <a href="{{ route('tickets.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus me-2"></i>Buat Tiket Sekarang
                                        </a>
                                    </div>
                                @else
                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>No. Tiket</th>
                                                    <th>Unit</th>
                                                    <th>Deskripsi</th>
                                                    <th>Status</th>
                                                    <th>Tanggal</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($tickets as $ticket)
                                                    <tr>
                                                        <td>{{ $ticket->ticket_number }}</td>
                                                        <td>{{ $ticket->unit }}</td>
                                                        <td>{{ Str::limit($ticket->description, 50) }}</td>
                                                        <td>
                                                            <span class="badge bg-{{ $ticket->status == 'pending' ? 'warning' :
                                                                                    ($ticket->status == 'progress' ? 'info' :
                                                                                    ($ticket->status == 'completed' ? 'success' : 'secondary')) }}">
                                                                {{ $ticket->status == 'pending' ? 'Pending' :
                                                                   ($ticket->status == 'progress' ? 'Dalam Proses' :
                                                                   ($ticket->status == 'completed' ? 'Selesai' : 'Dibatalkan')) }}
                                                            </span>
                                                        </td>
                                                        <td>{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                                                        <td>
                                                            <a href="{{ route('tickets.show', $ticket) }}" class="btn btn-sm btn-info text-white">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="d-flex justify-content-center mt-4">
                                        {{ $tickets->links() }}
                                    </div>
                                @endif
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

.table th {
    font-weight: 600;
}

.badge {
    font-weight: 500;
}
</style>
@endsection
