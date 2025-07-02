@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>

    <!-- Statistics Cards -->
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="small">Total Pendaftaran</div>
                            <div class="text-lg fw-bold">{{ $totalRegistrations }}</div>
                        </div>
                        <div>
                            <i class="fas fa-calendar fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="small">Pendaftaran Diproses</div>
                            <div class="text-lg fw-bold">{{ $pendingRegistrations }}</div>
                        </div>
                        <div>
                            <i class="fas fa-clock fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="small">Pendaftaran Selesai</div>
                            <div class="text-lg fw-bold">{{ $processingRegistrations }}</div>
                        </div>
                        <div>
                            <i class="fas fa-check-circle fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="small">Pendaftaran Dibatalkan</div>
                            <div class="text-lg fw-bold">{{ $completedRegistrations }}</div>
                        </div>
                        <div>
                            <i class="fas fa-times-circle fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Survey Results -->
    <div class="row">
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Hasil Survey Kepuasan
                </div>
                <div class="card-body">
                    @if(isset($averageRatings))
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Kategori</th>
                                    <th>Rating</th>
                                    <th>Visualisasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Pelayanan Medis</td>
                                    <td>{{ number_format($averageRatings['pelayanan_medis'], 1) }}/5.0</td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-success" role="progressbar" 
                                                style="width: {{ ($averageRatings['pelayanan_medis']/5)*100 }}%">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Fasilitas</td>
                                    <td>{{ number_format($averageRatings['fasilitas'], 1) }}/5.0</td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-info" role="progressbar" 
                                                style="width: {{ ($averageRatings['fasilitas']/5)*100 }}%">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kecepatan Pelayanan</td>
                                    <td>{{ number_format($averageRatings['kecepatan_pelayanan'], 1) }}/5.0</td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-warning" role="progressbar" 
                                                style="width: {{ ($averageRatings['kecepatan_pelayanan']/5)*100 }}%">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @else
                    <p class="text-center text-muted my-3">Belum ada data survey.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recent Tickets -->
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-ticket-alt me-1"></i>
                    Tiket Terbaru
                </div>
                <div class="card-body">
                    @if($recentTickets->count() > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No. Tiket</th>
                                    <th>Subjek</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentTickets as $ticket)
                                <tr>
                                    <td>{{ $ticket->ticket_number }}</td>
                                    <td>{{ Str::limit($ticket->subject, 30) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $ticket->status == 'open' ? 'warning' : ($ticket->status == 'in_progress' ? 'info' : 'success') }}">
                                            {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                                        </span>
                                    </td>
                                    <td>{{ $ticket->created_at->format('d/m/Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <p class="text-center text-muted my-3">Belum ada tiket.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 