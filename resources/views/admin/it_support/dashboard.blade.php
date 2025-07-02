@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('content-header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Dashboard IT Support</h1>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 mb-4">Dashboard IT Support</h1>

    <!-- Stats Cards Row -->
    <div class="row g-4 mb-4">
        <!-- Total Tickets Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="display-4 mb-0">{{ $ticketData['total'] ?? ($ticketData['pending'] + $ticketData['in_progress'] + $ticketData['completed']) }}</h1>
                            <div class="fs-6 mt-2">Total Tiket</div>
                        </div>
                        <div class="fs-1">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                    </div>
                </div>
                <a href="{{ route('admin.tickets.index') }}" class="card-footer d-flex align-items-center justify-content-between text-white text-decoration-none">
                    <span class="small">Lihat Detail</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Pending Tickets Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="display-4 mb-0">{{ $ticketData['pending'] }}</h1>
                            <div class="fs-6 mt-2">Tiket Pending</div>
                        </div>
                        <div class="fs-1">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                </div>
                <a href="{{ route('admin.tickets.index', ['status' => 'pending']) }}" class="card-footer d-flex align-items-center justify-content-between text-white text-decoration-none">
                    <span class="small">Lihat Detail</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- In Progress Tickets Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-info text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="display-4 mb-0">{{ $ticketData['in_progress'] }}</h1>
                            <div class="fs-6 mt-2">Tiket Diproses</div>
                        </div>
                        <div class="fs-1">
                            <i class="fas fa-spinner"></i>
                        </div>
                    </div>
                </div>
                <a href="{{ route('admin.tickets.index', ['status' => 'in_progress']) }}" class="card-footer d-flex align-items-center justify-content-between text-white text-decoration-none">
                    <span class="small">Lihat Detail</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Completed Tickets Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="display-4 mb-0">{{ $ticketData['completed'] }}</h1>
                            <div class="fs-6 mt-2">Tiket Selesai</div>
                        </div>
                        <div class="fs-1">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                </div>
                <a href="{{ route('admin.tickets.index', ['status' => 'completed']) }}" class="card-footer d-flex align-items-center justify-content-between text-white text-decoration-none">
                    <span class="small">Lihat Detail</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row mb-4">
        <!-- Priority Distribution Chart -->
        <div class="col-xl-6">
            <div class="card h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="m-0 font-weight-bold">
                        <i class="fas fa-chart-pie me-2"></i>
                        Distribusi Prioritas Tiket
                    </h5>
                </div>
                <div class="card-body">
                    <div style="height: 300px;">
                        <canvas id="priorityChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Distribution Chart -->
        <div class="col-xl-6">
            <div class="card h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="m-0 font-weight-bold">
                        <i class="fas fa-chart-bar me-2"></i>
                        Status Tiket
                    </h5>
                </div>
                <div class="card-body">
                    <div style="height: 300px;">
                        <canvas id="statusChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Tickets Table -->
    <div class="card mb-4">
        <div class="card-header bg-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="m-0 font-weight-bold">
                    <i class="fas fa-table me-2"></i>
                    Tiket Terbaru
                </h5>
                <a href="{{ route('admin.tickets.index') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-list me-1"></i> Lihat Semua
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>No. Tiket</th>
                            <th>Unit</th>
                            <th>Subjek</th>
                            <th>Prioritas</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($latestTickets ?? $tickets->take(5) as $ticket)
                        <tr>
                            <td>{{ $ticket->ticket_number }}</td>
                            <td>{{ $ticket->unit }}</td>
                            <td>{{ Str::limit($ticket->subject, 50) }}</td>
                            <td>
                                <span class="badge bg-{{ $ticket->priority == 'high' ? 'danger' : ($ticket->priority == 'medium' ? 'warning' : 'info') }}">
                                    {{ ucfirst($ticket->priority) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $ticket->status == 'completed' ? 'success' : ($ticket->status == 'in_progress' ? 'primary' : 'secondary') }}">
                                    {{ str_replace('_', ' ', ucfirst($ticket->status)) }}
                                </span>
                            </td>
                            <td>{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.tickets.show', $ticket) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-ticket-alt fa-3x mb-3"></i>
                                    <p>Tidak ada tiket terbaru</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Priority Distribution Chart
    const priorityCtx = document.getElementById('priorityChart');
    new Chart(priorityCtx, {
        type: 'pie',
        data: {
            labels: ['Tinggi', 'Sedang', 'Rendah'],
            datasets: [{
                data: [
                    {{ $ticketData['high'] ?? 0 }}, 
                    {{ $ticketData['medium'] ?? 0 }}, 
                    {{ $ticketData['low'] ?? 0 }}
                ],
                backgroundColor: ['#dc3545', '#ffc107', '#0dcaf0']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Status Distribution Chart
    const statusCtx = document.getElementById('statusChart');
    new Chart(statusCtx, {
        type: 'bar',
        data: {
            labels: ['Pending', 'Diproses', 'Selesai'],
            datasets: [{
                label: 'Jumlah Tiket',
                data: [
                    {{ $ticketData['pending'] ?? 0 }}, 
                    {{ $ticketData['in_progress'] ?? 0 }}, 
                    {{ $ticketData['completed'] ?? 0 }}
                ],
                backgroundColor: ['#6c757d', '#0d6efd', '#198754']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>
@endpush
@endsection 